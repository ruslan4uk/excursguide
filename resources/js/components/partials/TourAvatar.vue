<template>
    <div class="tour__av text-center pr-4">
        <div class="tour__avatar mb-2">
            <img :src="avatar + timestamp" alt="" class="border25">                 
        </div>
        <!-- <a href="" class="profile__avatar-upload">Добавить фото</a> -->
        <label for="profile-avatar" class="profile__avatar-upload">Добавить обложку экскурсии</label>
        <input type="file" name="avatar" ref="avatar" id="profile-avatar" class="profile__avatar-uploader" @change="changeAvatar">
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
export default {
    props: ['tourId'],
    data() {
        return {
            comAvatar: this.avatar || '/images/general/blank.png',
            image: '',
            timestamp: '',
        }
    },
    computed: {
        ...mapGetters('tour', ['tour']),

        avatar() {
            return this.tour.avatar ? this.tour.avatar : '/images/general/blank.png'
        },
    },
    methods: {
        ...mapMutations('tour', ['setAvatar']),

        changeAvatar() {
            this.image = this.$refs.avatar.files[0];   
            let formData = new FormData
            formData.append('file', this.image)
            formData.append('id', this.tourId)
            axios.post('/api/profile/tours/upload/avatar', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.timestamp = '?' + Math.floor(Date.now() / 1000)
                    this.setAvatar(response.data)
                })
                .catch(err => {
                    console.log('error');
                })
        }
    }
}
</script>

<style scoped lang="sass">
.tour__av
    max-width: 15rem
</style>