<template>
    <div class="row">
        <div class="col">
            <div class="locations">
                <div class="locations__list" v-if="city.length > 0">
                    <div class="custom-input mb-3" v-for="(item,index) in city" :key="index">
                        <input type="text" id="location" class="form-control" placeholder=" " :value="item.city + ', ' + item.country_name" disabled />
                        <label for="location">{{ placeholder || 'Введите' }}</label>
                        <div class="deleteCity" @click="deleteLocation(item.id)"><i class="fas fa-times"></i></div>
                    </div>
                </div>
                
                <div class="custom-input mb-3" v-if="city.length === 0 || showNewBtn">
                    <input type="text" id="location" :class="'form-control' + [errors ? ' is-invalid' : '']" placeholder=" " @input="searchName($event.target.value)" />
                    <label for="location">{{ placeholder || 'Введите' }}</label>
                    <div class="suggest block-shadow" v-if="cities.length > 0" v-click-outside="clearCities">
                        <div class="suggest__item" 
                            v-for="(item,index) in cities" :key="index"
                            @click="changeSuggest(item.id)">{{item.city}}, {{item.country_name}}</div>
                    </div>
                </div>
                      
            </div>
        </div>
        <div class="col-auto">
            <div class="custom-input mb-0 pb-0">
                <div class="btn btn-sm btn-small btn-blue js--location-add" @click="addNewBtn">Добавить</div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import ClickOutside from 'vue-click-outside'

export default {
    props: ['placeholder', 'locations', 'errors'],
    data() {
        return {
            showNewBtn: false,
        }
    },
    computed: {
        ...mapState('geo', ['city', 'cities', 'show'])
    },
    methods: {
        ...mapActions('geo', ['searchIds', 'searchName']),
        ...mapMutations('geo', ['clearCities']),

        addNewBtn () {
            this.showNewBtn = true
        },
        deleteLocation (id) {
            this.$emit('delete', id)
        },
        changeSuggest(id) {
            this.showNewBtn = false
            this.$emit('change', id)
        },
    },
    watch: {
        'locations'(newVal) {
            newVal ? this.searchIds(newVal) : ''
        },
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