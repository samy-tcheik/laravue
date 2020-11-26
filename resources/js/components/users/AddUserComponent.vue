<template>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Add New User</h4>
            </div>
            <form @submit.prevent="store">
            <div class="card-body">
                <div v-if="validationErrors" >
                <ul class="alert alert-danger">
                    <li v-for="(value, name) in validationErrors" :key="name">{{ value[0] }}</li>
                </ul>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input v-model="users.name" type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input v-model="users.email" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input v-model="users.password" type="text" name="name" class="form-control">
                </div>
                <h5>Select a role:</h5>
                <div class="custom-control custom-radio">
                    <input type="radio" value="admin" v-model="users.role" id="admin" name="role" class="custom-control-input">
                    <label class="custom-control-label" for="admin">Admin</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" value="author" v-model="users.role" id="author" name="role" class="custom-control-input">
                    <label for="author" class="custom-control-label">Author</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" value="user" v-model="users.role" name="role" id="role" class="custom-control-input">
                    <label for="user" class="custom-control-label">User</label>
                </div>

            </div>
            <div class="card-footer">
                <router-link :to="{ name: 'user_manager' }" class="btn btn-danger float-left">Cancel</router-link>
                <button class="btn btn-success float-right" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

    methods: {
        store(){
            axios.post('http://stage.test/admin/users',this.users)
            .then(Response => {
                if (Response.status === 200) {
                    this.$router.replace({ name: 'user_manager' })
                }
            }).catch(error => {
                if (error.response.status === 422) {
                    this.validationErrors = error.response.data.errors
                }
            })
        }
    },

    data() {
        return {
            users: {},
            validationErrors: null
        }
    }
}
</script>