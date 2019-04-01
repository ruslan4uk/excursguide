<template>
    <div class="tags">
        <div class="tags__label" v-if="label">{{label}}</div>
        <div class="tags__active" v-for="(active,index) in selected" :key="index">
            {{activeSelect(active)}}
            <div class="tags__delete" @click="deleteSelect(active)"><i class="fas fa-times"></i></div>
        </div>

        <div :class="'select position-relative' + [errors ? ' is-invalid' : '']" v-if="Object.keys(this.comSelected).length > 0" v-click-outside="hide">
            <div class="select__name" @click="suggest = !suggest">{{placeholder || 'Выберите'}}</div>
            <div class="select__list" v-if="suggest">
                <div class="select__item" v-for="(item, index) in comSelected" :key="index" @click="changeSelect(item.uid)">{{item.title}}</div>
            </div>
        </div>
    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'
export default {
    name: 'Tags',
    props: ['placeholder', 'options', 'selected', 'label', 'errors'],
    data() {
        return {
            comSelected: {},
            suggest: false,
        }
    },
    methods: {
        activeSelect(id) {
            return this.options.find(x => x.uid === id).title
        },
        hide() {
            this.suggest = false
        },
        changeSelect(uid) {
            this.$emit('change', uid)
            this.hide()
        },
        deleteSelect(uid) {
            this.$emit('delete', uid)
        }
    },
    computed: {
        
    },
    watch: {
        'selected'(newVal) {
            newVal 
                ? this.comSelected = this.options.filter(x => !newVal.includes(x.uid)) 
                : this.comSelected = this.options
        }
    },
    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">
.tags 
    display: flex
    flex-wrap: wrap
    &__label
        flex: 0 0 100%
        color: #405089
        font-weight: 500
        font-size: 0.75rem
        margin-bottom: 0.5rem
    &__active
        font-size: 0.75rem
        padding: 0.25rem 2.5rem 0.25rem 0.5rem
        border: 1px solid #ccc
        border-radius: 4px
        margin-right: 0.5rem
        margin-bottom: 0.5rem
        position: relative 
        font-weight: 500
        color: #75797e
    &__delete 
        position: absolute
        right: 0.375rem
        top: 0.25rem
        cursor: pointer
.select 
    &__name
        font-size: 0.75rem
        font-weight: 500 
        padding: 0.25rem 2.5rem 0.25rem 0
        border-bottom: 1px solid #e7e7e8
        cursor: pointer
        color: #405089
        &:after
            content: ' '
            position: absolute
            border-style: solid
            border-width: 0 5px 5px 5px
            border-color: transparent transparent #405089 transparent
            right: 0
            top: 0.625rem
            width: 0.625rem
            height: 0.5rem
            transform: rotate(180deg)
    &__list
        font-size: 0.75rem
        position: absolute
        z-index: 2
        background-color: #ffffff
        border-radius: 4px
        width: 100%
        box-shadow: 0 0 4px 2px rgba(0,0,0,.1)
    &__item
        padding: 0.5rem
        cursor: pointer 
        &:hover
            background-color: #eeeeee
    
    &.is-invalid &__name
        border-bottom: 1px solid #dc3545
        color: #dc3545
</style>