<template>
    <div class="container" v-if="users.role">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
            </div>
            <form @submit.prevent="update(users.id)">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input v-model="users.name" id="name" type="text"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input v-model="users.email" type="email" class="form-control" id="email" aria-describedby="emailHelp" >
                    </div>
                    <h4>User role :</h4>
                    <div class="form-check">
                        <input v-model="users.role" value="admin" type="radio" id="admin" name="role" class="form-check-input">
                        <label for="admin">Admin</label>
                    </div>
                    <div class="form-check">
                        <input v-model="users.role" value="author" type="radio" id="author" name="role" class="form-check-input">
                        <label for="author">Author</label>
                    </div>
                    <div class="form-check">
                        <input v-model="users.role" value="user" type="radio" id="user" name="role" class="form-check-input">
                        <label for="user">User</label>
                    </div>
                </div>
                <div class="card-footer">
                    <router-link :to="{ name: 'user_manager' }" class="btn btn-danger">Cancel</router-link>
                    <button type="submit" class="btn btn-success float-right">Apply</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {

    methods : {
        update: function(id) {
            axios.put('http://stage.test/admin/users/' + id, this.users )
            .then(Response => {
                if (Response.status === 200) {
                    this.$router.replace({name: 'user_manager'})
                }
            })
        }
    },
    
    data() {
        return {
            users: {}
        }
    },

    created() {
        
        axios.get('http://stage.test/admin/users/' + this.$route.params.user_id + '/edit')
        .then(Response => {this.users = Response.data});
    },

    mounted() {
        console.log('component mounted')
        console.log(this.users)
    }
}
</script>