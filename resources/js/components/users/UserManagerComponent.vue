<template>
  <div class="container">
    <div class="row">
      <div class="col-lg"><CreateForm @force-render="forceRender"></CreateForm></div>
      
    </div>
    <div class="row">
      <div class="col-lg">
        <UserTableVue :key="componentKey" @force-render="forceRender"></UserTableVue>
      </div>
    </div>
  </div>
</template>
<script>
import UserTableVue from './UserTable.vue';
import CreateForm from './forms/CreateForm'
export default {
  components: {UserTableVue, CreateForm},
  data() {
    return {
      users: {},
      componentKey: 0,
    }
  },
  
  methods: {

    forceRender: function() {
      this.componentKey += 1
    },
  },

  mounted() {
    console.log("Component mounted.");
    axios.get('http://stage.test/admin/users')
    .then(Response => {
      this.users = Response.data
    })
  },
};
</script>
