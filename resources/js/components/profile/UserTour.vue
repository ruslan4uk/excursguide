<template>
    <section class="profile mt-5">
        <div class="container">
            <div class="row">
                <div class="col-8 col-lg-3 mb-4 mb-lg-0">
                    <!-- avatar -->
                    <tour-avatar :tourId="tour.id"></tour-avatar>
                </div>
                <div class="col-12 col-lg-9">
                    <form method="POST" action="" @submit.prevent="saveTour(t)">
                        <!-- General -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-4">Основная информация</div>

                                <div class="form-group custom-input mb-4">
                                    <input type="text" name="name" id="tour_name" 
                                            :class="'form-control' 
                                                    + [errors['name'] ? ' is-invalid' : ''] 
                                                    + [success.messages ? ' is-valid' : '']" 
                                            :value="tour.name" @input="setName($event.target.value)"
                                            placeholder="Введите название экскурсии">
                                    <label for="tour_name">Введите название экскурсии</label>
                                    <span class="invalid-feedback" role="alert" v-if="errors.name">
                                        <strong>{{ errors.name[0] }}</strong>
                                    </span>
                                </div>
                                
                                <!-- Location -->
                                <tour-city 
                                        :location="tour.location"
                                        :placeholder="'Введите город отправления'"
                                        @change="setLocation" 
                                        @delete="deleteLocation"></tour-city>

                                <!-- Route -->
                                <div class="form-group custom-input mb-4 mt-4">
                                    <input type="text" name="name" id="tour_route" 
                                            :class="'form-control' 
                                                    + [errors['route'] ? ' is-invalid' : ''] 
                                                    + [success.messages ? ' is-valid' : '']" 
                                            :value="tour.route" @input="setRoute($event.target.value)"
                                            placeholder="Маршрут экскурсии">
                                    <label for="tour_route">Маршрут экскурсии</label>
                                    <span class="form-helper">Введите краткое описание маршрута, напр. Колизей — Ватикан — Вилла Д’Эсте</span>
                                    <span class="invalid-feedback" role="alert" v-if="errors.route">
                                        <strong>{{ errors.route[0] }}</strong>
                                    </span>
                                </div>

                                <!-- Language -->
                                <div class="form-group custon-input mb-4">
                                    <tags  
                                        :placeholder="'Выберите языки'" 
                                        :options="languages" 
                                        :selected="tour.languages"
                                        :errors="errors.languages"
                                        @change="addLang"
                                        @delete="deleteLang"></tags>

                                    <span class="invalid-feedback d-block" role="alert" v-if="errors.languages">
                                        <strong>{{errors.languages[0]}}</strong>
                                    </span>
                                    
                                </div>

                            </div>
                        </div>

                        <!-- Other 1 -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Категория экскурсии -->
                                    <div class="col-12 col-md-6 mt-3">
                                        <!-- <div class="card-subtitle">Категория экскурсии</div> -->
                                        <div class="form-group custom-input mb-4">
                                            <vue-select 
                                                :option="tourCategory"
                                                :current="tour.category"
                                                :placeholder="'Категория эскурсии'"
                                                :errors="errors.category"
                                                :success="success"
                                                @change="setCategory"></vue-select>
                                            <span class="invalid-feedback d-block" role="alert" v-if="errors.category">
                                                <strong>{{errors.category[0]}}</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Экскурсия доступна для... -->
                                    <div class="col-12 col-md-6 mt-3">
                                        <!-- <div class="card-subtitle">Экскурсия доступна для...</div> -->
                                        <div class="form-group custom-input mb-4">
                                            <vue-select 
                                                :option="peopleCategory"
                                                :current="tour.people_category"
                                                :placeholder="'Экскурсия доступна для...'"
                                                :errors="errors.people_category"
                                                :success="success"
                                                @change="setPeopleCategory"></vue-select>
                                            <span class="invalid-feedback d-block" role="alert" v-if="errors.people_category">
                                                <strong>{{errors.people_category[0]}}</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Количество участников -->
                                    <div class="col-12 col-md-3">
                                        <div class="form-group custom-input mb-4">
                                            <input type="number" name="name" id="people_count" 
                                                    :class="'form-control' 
                                                            + [errors['people_count'] ? ' is-invalid' : ''] 
                                                            + [success.messages ? ' is-valid' : '']" 
                                                    :value="tour.people_count" @input="setPeopleCount($event.target.value)"
                                                    placeholder="Количество участников">
                                            <label for="people_count">Количество участников</label>
                                            <span class="invalid-feedback" role="alert" v-if="errors.people_count">
                                                <strong>{{ errors.people_count[0] }}</strong>
                                            </span>
                                        </div>
                                    </div>


                                    <!-- Длительность экскурсии -->
                                    <div class="col-12 col-md-3">
                                        <div class="form-group custom-input mb-4">
                                            <vue-select 
                                                :option="tourTiming"
                                                :current="tour.timing"
                                                :placeholder="'Длительность экскурсии'"
                                                :errors="errors.timing"
                                                :success="success"
                                                @change="setTiming"></vue-select>
                                            <span class="invalid-feedback d-block" role="alert" v-if="errors.timing">
                                                <strong>{{errors.timing[0]}}</strong>
                                            </span>
                                        </div>
                                    </div>


                                    <!-- Стоимость -->
                                    <div class="col-12 col-md-6">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="custom-input mb-0">
                                                    <input type="number" name="name" id="price" 
                                                        :class="'form-control' 
                                                                + [errors['price'] ? ' is-invalid' : ''] 
                                                                + [success.messages ? ' is-valid' : '']" 
                                                        :value="tour.price" @input="setPrice($event.target.value)"
                                                        placeholder="Стоимость">
                                                    <label for="price">Стоимость</label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="custom-input mb-0">
                                                    <vue-select 
                                                        :option="tourCurrency"
                                                        :current="tour.currency"
                                                        :placeholder="'Валюта'"
                                                        :errors="errors.currency"
                                                        :success="success"
                                                        @change="setCurrency"></vue-select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="custom-input mb-0">
                                                    <vue-select 
                                                        :option="tourPriceType"
                                                        :current="tour.price_type"
                                                        :placeholder="'Выберите'"
                                                        :errors="errors.price_type"
                                                        :success="success"
                                                        @change="setPriceType"></vue-select>
                                                </div>
                                            </div>

                                        </div>
                                        <span class="invalid-feedback invalid-feedback--small d-block" role="alert" v-if="errors.price">
                                            <strong>{{ errors.price[0] }}</strong>
                                        </span>
                                        <span class="invalid-feedback invalid-feedback--small d-block" role="alert" v-if="errors.currency">
                                            <strong>{{ errors.currency[0] }}</strong>
                                        </span>
                                        <span class="invalid-feedback d-block" role="alert" v-if="errors.price_type">
                                            <strong>{{errors.price_type[0]}}</strong>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Other 2 -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body pt-4">
                                
                                <div class="row">
                                    <!-- Услуги -->
                                    <div class="col-12 col-md-6">
                                        <div class="form-group custom-input">
                                            <input type="text" name="name" id="tour_services" 
                                                    :class="'form-control' 
                                                            + [errors['services'] ? ' is-invalid' : ''] 
                                                            + [success.messages ? ' is-valid' : '']" 
                                                    :value="tour.services" @input="setServices($event.target.value)"
                                                    placeholder="Услуги">
                                            <label for="tour_services">Услуги</label>
                                            <div class="form-helper">Введите через запятую услуги, которые входят в экскурсию</div>
                                            <span class="invalid-feedback" role="alert" v-if="errors.services">
                                                <strong>{{ errors.services[0] }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Дополнительные расходы -->
                                    <div class="col-12 col-md-6">
                                        <div class="form-group custom-input mb-4">
                                            <input type="text" name="name" id="tour_other_rate" 
                                                    :class="'form-control' 
                                                            + [errors['other_rate'] ? ' is-invalid' : ''] 
                                                            + [success.messages ? ' is-valid' : '']" 
                                                    :value="tour.other_rate" @input="setOtherRate($event.target.value)"
                                                    placeholder="Дополнительные расходы">
                                            <label for="tour_other_rate">Дополнительные расходы</label>
                                            <div class="form-helper">Введите через запятую услуги, которые входят в экскурсию</div>
                                            <span class="invalid-feedback" role="alert" v-if="errors.other_rate">
                                                <strong>{{ errors.other_rate[0] }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Что с собой взять -->
                                    <div class="col-12 col-md-6">
                                        <div class="form-group custom-input mb-4">
                                            <input type="text" name="name" id="tour_other_item" 
                                                    :class="'form-control' 
                                                            + [errors['other_item'] ? ' is-invalid' : ''] 
                                                            + [success.messages ? ' is-valid' : '']" 
                                                    :value="tour.other_item" @input="setOtherItem($event.target.value)"
                                                    placeholder="Что с собой взять">
                                            <label for="tour_other_item">Что с собой взять</label>
                                            <span class="invalid-feedback" role="alert" v-if="errors.other_item">
                                                <strong>{{ errors.other_item[0] }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                


                            </div>
                        </div>


                        <!-- About tour  -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-0">Расскажите туристам об экскурсии</div>
                                <div class="card-title-small mb-3">не использовать тексты с других сайтов. Проверить уникальность текста text.ru</div>
                                <div class="form-group custom-input">
                                    <textarea name="tour" id="tour_about" cols="30" rows="10" 
                                            :class="'form-control' 
                                                    + [errors['about'] ? ' is-invalid' : ''] 
                                                    + [success.messages ? ' is-valid' : '']" 
                                            :value="tour.about" @input="setAbout($event.target.value)"></textarea>
                                    
                                    <span class="invalid-feedback d-block" role="alert" v-if="errors.about">
                                        <strong>{{errors.about[0]}}</strong>
                                    </span>
                                
                                </div>
                            </div>
                        </div>


                        <!-- Photo Uploader  -->
                        <div class="card block-shadow border25 mb-4">
                            <div class="card-body">
                                <div class="card-title mb-3">Фото экскурсии</div>
                                <div class="form-group custom-input">
                                    
                                    <tour-photo :data="tour.photo" ></tour-photo>
                                    
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

import TourCity from '../partials/TourCity'
import Tags from '../partials/Tags'
import VueSelect from '../partials/VueSelect'
import TourAvatar from '../partials/TourAvatar'
import TourPhoto from '../partials/TourPhoto'

export default {
    props: ['t'],
    components: { TourCity, Tags, VueSelect, TourAvatar, TourPhoto },

    computed: {
        ...mapState('tour', ['tour', 'errors', 'success']),
        ...mapGetters('config', ['languages', 'tourCategory', 'peopleCategory', 'tourTiming', 
                                'tourCurrency', 'tourPriceType']),
    },
    methods: {
        ...mapActions('tour', ['getTour', 'saveTour']),
        ...mapMutations('tour', ['setName', 'setLocation', 'deleteLocation', 'setRoute', 'addLang', 'deleteLang', 
                                'setServices', 'setOtherRate', 'setOtherItem', 'setAbout', 'setCategory', 
                                'setPeopleCategory', 'setPeopleCount', 'setTiming', 'setCurrency', 'setPrice', 'setPriceType']),

        submitForm() {
            this.saveTour();
        },
    },
    mounted() {
        this.getTour(this.t);
    },
}
</script>

<style scoped lang="sass">

</style>