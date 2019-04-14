<template>
    <div class="row">
        <div class="col-12 col-md" v-if="user_data.contacts">
            <contact-item 
                v-for="(item, index) in user_data.contacts" 
                :key="index" 
                :type="contactType" 
                :contact="item" 
                :index="index"></contact-item>
            
        </div>
        <div class="col-auto">
            <div class="custom-input mb-0 pb-0">
                <div class="btn btn-sm btn-small btn-blue js--location-add" @click="addContacts">Добавить</div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import ContactItem from './ContactItem'
export default {
    components: { ContactItem },
    data() {
        return {
            comContacts: []
        }
    },
    computed: {
        ...mapState('profile', ['user_data']),
        ...mapGetters('profile', ['errors']),
        ...mapGetters('config', ['contactType'])
    },
    methods: {
        ...mapMutations('profile', ['addContacts'])
    },
    watch: {
        'user_data.contacts'(newVal) {
            newVal === null ? this.addContacts() : newVal            
        }
    }
}
</script>

<style scoped lang="sass">

</style>