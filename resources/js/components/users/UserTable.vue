<template>
    <v-data-table
    :headers="headers"
    :items="users"
    :items-per-page="5"
    class="elevation-1"
  >
  <template v-slot:[`item.actions`]="{ item }">
      <EditForm v-bind:userId="item.id"></EditForm>
      <v-icon
        small
        @click="deleteUser(item.id)"
      >
        mdi-delete
      </v-icon>
    </template>
  </v-data-table>
</template>
<script>
import EditForm from './forms/EditForm';
export default {
    components: {EditForm},
    data() {
        return {
            headers:  [
                { text: 'name', value: 'name'},
                {text: 'email', value: 'email'},
                {text: 'role', value: 'role'},
                {text: 'actions', value: 'actions'}
            ],
            users: [],
            roles: [],
            componentKey: 0,
        }
    },

    methods: {

      deleteUser: function (id) {
      this.$confirm('<p class="justify-center">Do you really want to delete this user</p>?', { title:'Warning', color:'warning', color:'warning'}).then(res => {
        axios.delete('http://stage.test/admin/users/' + id)
        .then(Response => {
          if (Response.status === 200) {
            this.$emit('force-render')
          }
        })
      })
    }
    },

    created() {
        axios.get('http://stage.test/admin/users')
    .then(Response => {
      this.users = Response.data
    })
    },
}
</script>