<template>
    <div class="vue-select" v-click-outside="hide">
        <div :class="'vue-select__current' + [errors ? ' is-invalid' : ''] + [success.messages ? ' is-valid' : '']" @click="suggest = !suggest">
            {{ comCurrent }}
            <div :class="'vue-select__placeholder' + [current || suggest ? ' is-active' : '']">{{placeholder}}</div>
        </div>
        <div class="vue-select__suggest" v-if="option && suggest">
            <div class="vue-select__suggest-item" v-for="(item, index) in option" :key="index" @click="change(item.id)">
                {{item.title}}
            </div>
        </div>
    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
    props: ['option', 'current', 'placeholder', 'errors', 'success'],
    data() {
        return {
            suggest: false,
            comOption: Object.assign(this.option) || null,
        }
    },
    computed: {
        comCurrent() {
            return this.current != null && this.option.length > 0
                ? this.option.find(x => x.id === Number.parseInt(this.current)).title
                : ''
        }
    },
    methods: {
        open () {
            this.suggest = true
        },
        hide () {
            this.suggest = false
        },
        change (id) {
            this.$emit('change', id)
            this.suggest = false
        }
    },

    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">
.vue-select
    position: relative

    &__placeholder
        position: absolute
        color: #405089
        font-size: 0.75rem
        font-weight: 500
        top: 0.375rem
        transition: all ease 0.2s
        margin-bottom: 0.5rem
        &.is-active
            top: -0.675rem
            font-size: 0.675rem

    &__current
        cursor: pointer
        position: relative
        font-size: 0.75rem
        font-weight: 500
        display: block
        width: 100%
        height: calc(1.6em + 0.75rem + 2px)
        padding: 0.375rem 0.75rem 0.375rem 0
        line-height: 1.6
        background-color: #fff
        background-clip: padding-box
        border-bottom: 1px solid #eeeeee
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out
        // is-invalid
        &.is-invalid 
            border-bottom: 1px solid #dc3545
            color: #dc3545
        &.is-valid 
            border-bottom: 1px solid #28a745
            
        &:after
            content: ' '
            position: absolute
            border-style: solid
            border-width: 0 5px 5px 5px
            border-color: transparent transparent #405089 transparent
            right: 0
            top: 0.875rem
            width: 0.625rem
            height: 0.5rem
            transform: rotate(180deg)
        
    // suggest
    &__suggest
        position: absolute
        z-index: 2
        width: 100% 
        background: #ffffff
        box-shadow: 0 0 4px 2px rgba(0, 0, 0, 0.1)
        max-height: 10rem
        overflow-y: scroll
        &-item
            padding: 0.5rem
            border-bottom: 1px solid #eeeeee
            font-size: 0.75rem
            font-weight: 300
            cursor: pointer
            &:hover
                background: #eeeeee

    // is-invalid
    &.is-invalid 
        border-bottom: 1px solid #dc3545
</style>