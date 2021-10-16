<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
export default {
    name: "FollowComponent",
    props: ['userId', 'follows'],
    mounted() {
        console.log('Follow Component mounted.');
    },
    data: function() {
        return {
            status: this.follows,
        }
    },
    methods: {
        followUser() {
            axios.post(`/follow/${this.userId}`)
                .then(res => {
                    this.status = ! this.status;
                    console.log(res.data);
                })
                .catch(err => {
                    // redirect to "/login" page if unauthorized request is made
                    if(err.response.status === 401) {
                        window.location = "/login";
                    }
                });
        }
    },
    computed: {
        buttonText() {
            return this.status ? 'Unfollow' : 'Follow';
        }
    }
}
</script>

<style scoped>

</style>
