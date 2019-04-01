<template>
    <div class="row">
        <div class="col-3">
            <div class="form-group custom-input position-relative mb-3" v-click-outside="hide">
                <div class="contact-type" @click="suggest = !suggest">{{label()}}</div>
                <div class="suggest-type" v-if="type.length > 0 && suggest">
                    <div class="suggest-type__item" 
                        v-for="(item,index) in type" :key="index" 
                        @click="changeType(item.id)">{{item.title}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="form-group custom-input mb-3">
                <input type="text" name="" :id="'contact_' + index" class="form-control" :value="itemContact.value" placeholder="Введите" @input="updateInput($event.target.value)">
                <label :for="'contact_' + index">Введите</label>
                
                <div class="deleteLocation" v-if="isDeleted" @click="deleteItemContact(index)"><i class="fas fa-times"></i></div>
            </div>
        </div>

        <div class="col-12">
            <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.contacts.' + index + '.value']">
                <strong>{{errors['user_data.contacts.' + index + '.value'][0]}}</strong>
            </span>
            <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.contacts.' + index + '.type_id']">
                <strong>{{errors['user_data.contacts.' + index + '.type_id'][0]}}</strong>
            </span>
        </div>
  
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import ClickOutside from 'vue-click-outside'
export default {
    props: ['index', 'contact', 'type'],
    data() {
        return {
            suggest: false,
        }
    },
    computed: {
        ...mapGetters('profile', ['getItemContacts', 'errors', 'user_data']),
        itemContact() {
            return this.getItemContacts[this.index]
        },
        isDeleted(){
            return this.user_data.contacts.length > 1 ? true : false
        },
    },  
    methods: {
        ...mapMutations('profile', ['setItemContactInput', 'setItemContactType', 'deleteItemContact']),

        updateInput(value) {
            this.setItemContactInput({item: value, index: this.index})
        },
        changeType(id) {
            this.setItemContactType({item: id, index: this.index})
            this.suggest = false
        },
        label() {
            return this.type.find(x => x.id === this.itemContact.type_id) 
                ? this.type.find(x => x.id === this.itemContact.type_id).title 
                : 'Выберите'
        },
        hide() {
            this.suggest = false
        }
    },
    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">
.contact-type
    font-size: 0.75rem
    font-weight: 500
    height: calc(1.6em + 0.75rem + 2px)
    padding: 0.375rem 0
    padding-top: 1em
    margin-bottom: 2px
    border-radius: 0
    color: #000000
    border-bottom: 1px solid #eeeeee
    cursor: pointer
    color: #405089
    position: relative
    &:after
        content: ' '
        position: absolute
        border-style: solid
        border-width: 0 5px 5px 5px
        border-color: transparent transparent #405089 transparent
        right: 0
        top: 1rem
        width: 0.625rem
        height: 0.5rem
        transform: rotate(180deg)
.suggest-type
    position: absolute
    z-index: 2
    background: #ffffff
    width: 100%
    max-height: 10rem
    overflow-y: scroll
    box-shadow: 0 3px 10px 5px rgba(0, 0, 0, 0.1)
    &__item
        font-size: 0.875rem
        font-weight: 400
        padding: 0.25rem 0.5rem
        border-bottom: 1px solid #ccc
        cursor: pointer
.deleteLocation
    position: absolute
    top: 0.375rem
    right: 0.5rem
</style>