<template>
    <div>
        <div class="main-search mt-5">
            <input type="text" name="" id="" v-model="searchInput" :class="{ active: suggestFlag }" class="main-search__input" placeholder="Введите город" @keyup="search($event.target.value)">
            <div class="main-search__btn btn-gradient">От винта!</div>
            <div class="main-search__suggest" v-if="suggestFlag" v-click-outside="hide">
                <div class="main-search__suggest-item" v-for="(item, index) in suggest" :key="index">
                    <a :href="'city/' + item.id + '/tours'" class="main-search__suggest-link">
                        {{ item.city }}, {{ item.country_name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClickOutside from "vue-click-outside";
export default {
    data() {
        return {
            searchInput: "",
            suggest: [],
            suggestFlag: false
        };
    },
    methods: {
        search(value) {
            axios
                .get("s?q=" + value)
                .then(r => r.data)
                .then(response => {
                    this.suggest = response;
                    console.log(response);
                });
        },
        hide() {
            this.suggest = [];
            this.suggestFlag = false;
            this.searchInput = "";
        }
    },
    watch: {
        suggest: function(val) {
            val.length > 0
                ? (this.suggestFlag = true)
                : (this.suggestFlag = false);
        }
    },
    directives: {
        ClickOutside
    }
};
</script>