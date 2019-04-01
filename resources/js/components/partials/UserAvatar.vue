<template>
    <div>
        <div class="profile__user d-flex align-items-center">
            <div class="profile__avatar mr-3">
                 <img :src="avatar + timestamp" alt="">                 
            </div>
            <div class="profile__username">{{profile.name}}</div>
        </div>
        <!-- <a href="" class="profile__avatar-upload">Добавить фото</a> -->
        <label for="profile-avatar" class="profile__avatar-upload">Добавить фото</label>
        <input type="file" name="avatar" ref="avatar" id="profile-avatar" class="profile__avatar-uploader" @change="changeAvatar">
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState, mapMutations} from 'vuex'
export default {
    data() {
        return {
            comAvatar: this.avatar || 'images/general/avatar-blank.jpg',
            image: '',
            timestamp: '',
        }
    },
    computed: {
        ...mapGetters('profile', ['profile', 'user_data']),

        avatar() {
            return this.user_data.avatar ? this.user_data.avatar : 'images/general/avatar-blank.jpg'
        },
    },
    methods: {
        ...mapMutations('profile', ['setAvatar']),

        changeAvatar() {
            this.image = this.$refs.avatar.files[0];   
            let formData = new FormData
            formData.append('file', this.image)
            axios.post('api/profile/upload/avatar', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.timestamp = '?' + Math.floor(Date.now() / 1000)
                    this.setAvatar(response.data)
                })
                .catch(err => {
                    console.log('error');
                })
        }
    }
}
</script>

<style scoped lang="sass">

</style>