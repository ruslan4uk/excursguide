<template>
    <div class="custom-input mb-3">
        <input type="text" :id="'city_' + id" class="form-control" placeholder=" " v-model="inputCity" :disabled="disabled" @input="searchName">
        <label :for="'city_' + id">{{ placeholder || 'Введите' }}</label>
        <div class="deleteCity" @click="deleteCity"><i class="fas fa-times"></i></div>
        <div class="suggest" v-if="cities">
            <div class="suggest__item" v-for="(item,index) in cities" :key="index" @click="changeCity(item.id)">{{ item.city }}, {{ item.country_name }}</div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import ClickOutside from 'vue-click-outside'
export default {
    props: ['current', 'placeholder', 'blank'],
    data() {
        return {
            id: Math.floor(Math.random() * (100 - 10) + 10),
            inputCity: '',
            city: {},
            cities: {},
        }
    },
    computed: {
        disabled () {
            return this.current ? true : false
        }
    },
    methods: {
        changeCity (id) {
            this.$emit('change', id);
            if(!this.blank) {
                this.searchId(id);
            } else {
                this.inputCity = ''
                this.city = {}
                this.cities = {}
            }
        },
        deleteCity () {
            this.$emit('delete', this.current)
        },

        async searchName (name) {
            console.log(name.target.value);
            
            await axios.get('/api/geo?q=' + name.target.value).then(r => r.data)
                .then(response => {
                    this.cities = response
                })
        },
        async searchId (id) {
            await axios.get('/api/geo?id=' + id).then(r => r.data)
                .then(response => {
                    this.city = response
                })
        }
    },
    mounted() {
        this.current ? this.searchId(this.current) : null
    },
    watch: {
        'city'(newVal) {
            this.inputCity = newVal.city + ', ' + newVal.country_name
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
</style>