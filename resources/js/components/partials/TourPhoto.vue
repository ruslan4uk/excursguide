<template>
    <div class="row">
        
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="col-6 col-md-4 mb-4" v-for="(item, index) in license" :key="index">
                    <div class="license__item license__item--background" :style="'background-image: url(' + item.path + ');'">
                        <div class="license__delete" @click="deleteLicense(index)">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 mb-4" v-if="license.length < 6">
                    <input type="file" name="" id="license" class="license__checkbox" ref="license" multiple
                        @change="changeLicense">
                    <label for="license" class="license__item license__item--after"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="license__helper">
                Можно загрузить картинку в формате 
                png, jpg и gif. Размеры не меньше 
                200 × 200 точек, объём файла 
                не больше 7 МБ.
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'

export default {
    props: ['data'],
    data() {
        return {
            timestamp: '',
            images: '',
        }
    },
    computed: {
        ...mapGetters('tour', ['tour']),
        license() {
            return this.tour.photo || []
        }
    },
    methods: {
        ...mapMutations('tour', ['setPhoto']),
        changeLicense() {
            this.images = this.$refs.license.files;
            let formData = new FormData
            for( var i = 0; i < this.images.length; i++ ){
                let file = this.images[i];
                formData.append('files[' + i + ']', file);
                formData.append('id', this.tour.id)
            }
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            axios.post('/api/profile/tours/upload/photo', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.setPhoto(response.data)
                    this.timestamp = '?' + Math.floor(Date.now() / 1000)
                })
        },
        deleteLicense(index) {
            axios.post('/api/profile/tours/upload/photo/delete', {id: index, tour_id: this.tour.id})
                .then(response => {
                    this.setPhoto(response.data)
                    this.timestamp = '?' + Math.floor(Date.now() / 1000)                    
                })
        }
    },
}
</script>

<style scoped lang="sass">
.license 
    &__helper
        font-size: 0.875rem
        font-weight: 400
        color: #999
    &__checkbox
        position: absolute
        left: -9999px
    &__item
        display: block
        height: 11rem
        border: 2px dashed #405089
        border-radius: 25px
        position: relative
        &:hover:before
            content: ' '
            position: absolute
            top: 0
            left: 0
            background-color: rgba(255,255,255,.75) 
            width: 100%
            height: 100%
            border-radius: 25px
        &--background
            background-size: cover
            background-repeat: no-repeat
            background-position: center center
        &--after
            margin-bottom: 0
            top: 0
            cursor: pointer
            &:after 
                position: absolute
                top: 50%
                content: 'Загрузить фото'
                text-align: center
                width: 100%
                max-width: 100% 
                color: #405089
                font-size: 0.75rem
                font-weight: 500
                padding: 0 1rem
    &__delete
        position: absolute 
        top: calc(50% - 1.5rem)
        right: calc(50% - 1.5rem)
        display: none
        font-size: 2.5rem
        color: #ff7555
        z-index: 2
        cursor: pointer
    &__item:hover &__delete 
        display: block
</style>