<template>
   <div class="form-group">
        <div class="custom-checkbox custom-checkbox--profile mr-4 mb-2" 
            v-for="(service,index) in services" :key="index">
            <input type="checkbox" 
                :value="service.id"
                v-model="checkServices"
                :id="'service' + service.id" 
                name="customRadioInline1" :class="'form-check-input' 
                                                    + [errors['user_data.services'] ? ' is-invalid' : ''] " >
            <label class="form-check-label" :for="'service' + service.id">{{ service.title }}</label>
        </div>

        <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.services']">
            <strong>{{errors['user_data.services'][0]}}</strong>
        </span>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
export default {
    data() {
        return {
            checkServices: []
        }
    },
    computed: {
        ...mapState('profile', ['user_data', 'errors', 'success']),
        ...mapGetters('config', ['services']),
    },
    methods: {
        ...mapMutations('profile', ['setServices']),
    },
    watch: {
        'checkServices'(newVal) {
            this.setServices(newVal)
        },
        'user_data.services'(newVal) {
            newVal instanceof Array ? this.checkServices = newVal : this.checkServices = []
        }
    }
}
</script>

<style scoped>

</style>