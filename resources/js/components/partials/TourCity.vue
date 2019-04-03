<template>
    <div class="custom-input mb-3">
        <input type="text" id="location" 
                :class="'form-control' + [errors.location ? ' is-invalid' : '']" 
                placeholder=" " 
                v-model="comCity" 
                @input="searchName($event.target.value)" 
                :disabled="disable" />
        <label for="location">{{ placeholder || 'Введите' }}</label>
        <div class="deleteCity" @click="deleteLocation()" v-if="disable"><i class="fas fa-times"></i></div>
        <div class="suggest block-shadow" v-if="cities.length > 0" v-click-outside="clearCities">
            <div class="suggest__item" 
                v-for="(item,index) in cities" :key="index"
                @click="changeSuggest(item.id)">{{item.city}}, {{item.country_name}}</div>
        </div>
        <span class="invalid-feedback d-block mt-0 pt-0" role="alert" v-if="errors.location">
            <strong>{{errors['location'][0]}}</strong>
        </span>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import ClickOutside from 'vue-click-outside'

export default {
    props: ['placeholder', 'location'],
    data() {
        return {
            show: true,
            comCity: '',
            disable: false,
        }
    },

    computed: {
        ...mapState('geo', ['city', 'cities']),
        ...mapGetters('tour', ['errors', 'success'])
    },
    methods: {
        ...mapActions('geo', ['searchIds', 'searchName']),
        ...mapMutations('geo', ['clearCities']),

        addNewBtn () {
            this.showNewBtn = true
        },
        deleteLocation () {
            this.comCity = ''
            this.$emit('delete')
        },
        changeSuggest(id) {
            this.searchName()
            this.showNewBtn = false
            this.$emit('change', id)
        },
    },
    watch: {
        'location'(newVal) {
            newVal ? this.disable = true : this.disable = false
            newVal ? this.searchIds(newVal) : ''
        },
        'city'(newVal) {
            console.log(newVal)
            newVal.length > 0 ? this.comCity = newVal[0].city + ', ' + newVal[0].country_name : ''
        }
    },
    directives: {
        ClickOutside
    },
}
</script>

<style scoped lang="sass">
.deleteCity 
    position: absolute
    top: 0.375rem
    right: 0.5rem

.suggest
    position: absolute 
    z-index: 2
    background: #ffffff
    width: 100%
    max-height: 10rem
    overflow-y: scroll
    box-shadow: 0 3px 10px 5px rgba(0, 0, 0, 0.1)
    &__item
        cursor: pointer
        font-size: 0.875rem
        padding: 0.25rem
        border-bottom: 1px solid #cccccc
        font-weight: 400
        transition: all ease 0.2s
        &:hover 
            background: #fafafa
</style>