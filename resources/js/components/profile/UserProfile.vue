<template>
    <section class="profile mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <user-avatar></user-avatar>
                </div>
                <div class="col-12 col-lg-9">
                    <form method="POST" action="" @submit.prevent="submitForm">
                        <!-- General -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-4">Основная информация</div>

                                <div class="form-group custom-input mb-4">
                                    <input type="text" name="name" id="user_name" 
                                            :class="'form-control' 
                                                    + [errors['name'] ? ' is-invalid' : ''] 
                                                    + [success.messages ? ' is-valid' : '']" 
                                            :value="profile.name" @input="setName"
                                            placeholder="Иванов Иван">
                                    <label for="user_name">Введите Ваше ФИО или название компании</label>
                                    <span class="invalid-feedback" role="alert" v-if="errors.name">
                                        <strong>{{ errors.name[0] }}</strong>
                                    </span>
                                </div>

                                <div class="card-subtitle mb-3">Владение языками</div>
                                <div class="form-group custon-input mb-4">
                                    <tags  
                                        :placeholder="'Выберите языки'" 
                                        :options="languages" 
                                        :selected="user_data.languages"
                                        :errors="errors['user_data.languages']"
                                        @change="addLang"
                                        @delete="deleteLang"></tags>

                                    <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.languages']">
                                        <strong>{{errors['user_data.languages'][0]}}</strong>
                                    </span>
                                    
                                </div>

                                <!-- Geolocation -->
                                <div class="card-subtitle mb-3">Ваше местоположение</div>
                                <city2 :locations="user_data.locations"
                                        :errors="errors['user_data.locations']"
                                        @change="addCity"
                                        @delete="deleteCity"></city2>
                                <span class="invalid-feedback d-block mt-0 pt-0" role="alert" v-if="errors['user_data.locations']">
                                    <strong>{{errors['user_data.locations'][0]}}</strong>
                                </span>
                                
                                <div class="card-subtitle mt-4">Контакты</div>
                                
                                <contacts></contacts>

                            </div>
                        </div>

                        <!-- Services -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-3">Услуги</div>
                                <user-services></user-services>
                            </div>
                        </div>

                        <!-- About user  -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-0">Расскажите туристам о себе</div>
                                <div class="card-title-small mb-3">не использовать тексты с других сайтов. Проверить уникальность текста <a href="text.ru" target="_blank">text.ru</a></div>
                                <div class="form-group custom-input">
                                    <textarea name="about" id="userdata_about" wrap="soft" cols="30" rows="10" 
                                            :class="'form-control' 
                                                    + [errors['user_data.about'] ? ' is-invalid' : ''] 
                                                    + [success.messages ? ' is-valid' : '']" 
                                            :value="user_data.about" @input="setAbout"></textarea>
                                    
                                    <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.about']">
                                        <strong>{{errors['user_data.about'][0]}}</strong>
                                    </span>
                                
                                </div>
                            </div>
                        </div>


                        <!-- License Uploader  -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-0">Лицензия гида</div>
                                <div class="card-title-small mb-3">Если у Вас есть лицензия, обязательно покажите ее, это повысит уровень доверия к Вам</div>
                                <div class="form-group custom-input">
                                    
                                    <license-uploader :data="user_data.user_files"></license-uploader>
                                    
                                    <span class="invalid-feedback d-block" role="alert" v-if="errors['user_data.user_files']">
                                        <strong>{{errors['user_data.user_files'][0]}}</strong>
                                    </span>
                                
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success mb-4" v-if="success.messages">
                            {{ success.messages }}
                        </div>

                        <div class="alert alert-danger mb-4" v-if="Object.keys(errors).length > 0">
                            Неправильно заполнены поля 
                        </div>

                        <div class="form-group custom-input d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-blue">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
import UserServices from '../partials/UserServices'
import Tags from '../partials/Tags'
import City from '../partials/City'
import City2 from '../partials/City2'
import Contacts from '../partials/contact/Contacts'
import UserAvatar from '../partials/UserAvatar'
import LicenseUploader from '../partials/LicenseUploader'

export default {
    components: {UserServices, Tags, City2, Contacts, UserAvatar, LicenseUploader},
    computed: {
        ...mapState('profile', ['profile', 'user_data', 'errors', 'success']),
        ...mapGetters('config', ['contactType', 'languages', 'services']),

    },
    methods: {
        ...mapActions('profile', ['getProfile', 'saveProfile']),
        ...mapMutations('profile', ['setName', 'setAbout', 'addLang', 'deleteLang', 
                                    'addCity', 'deleteCity']),

        ...mapActions('config', ['apiService']),

        submitForm() {
            this.saveProfile();
        },
    },
    mounted() {
        // get service from api
        this.apiService();
        // get profile from api
        this.getProfile();
    },
}
</script>

<style scoped>

</style>