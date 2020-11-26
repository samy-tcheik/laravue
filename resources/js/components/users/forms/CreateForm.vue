<template>
    <v-dialog v-model="open" justify-center max-width="700px">
        <template v-slot:activator="{on}">
            <v-btn
              class="float-right"
              fab
              dark
              color="indigo"
              v-on="on"
            >
               <v-icon dark>
                  mdi-plus
               </v-icon>
            </v-btn>
        </template>
        <v-card>
            <form @submit.prevent="submit">
            <v-card-text>
               <v-text-field
                v-model="name"
                :error-messages="nameErrors"
                label="Name"
                required
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
              ></v-text-field>
              <v-text-field
                v-model="email"
                :error-messages="emailErrors"
                label="E-mail"
                required
                @input="$v.email.$touch()"
                @blur="$v.email.$touch()"
              ></v-text-field>
              <v-text-field
              v-model="password"
              label="password"
              :error-messages="passwordErrors"
              required
              @input="$v.password.$touch()"
              @blur="$v.password.$touch()">
              </v-text-field>
              <v-select
              v-model="role"
              :items="items"
              label="Role"
              ></v-select>
            </v-card-text>
            
            <v-card-actions>
              <v-btn
              color="blue darken-1"
              text
              @click="dialog = false"
              >close</v-btn>
              <v-btn
              color="blue darke-1"
              text
              type="submit"
              >apply</v-btn>
            </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'
  
  export default {
    mixins: [validationMixin],

    validations: {
      name: { required, maxLength: maxLength(10) },
      email: { required, email },
      password: { required, minLength: minLength(8)}
    },

    data () {
        return {
                open: false,
                dialog: false,
                name: '',
                email: '',
                password: '',
                items: [],
                role: ''
            }
    },
      
    computed: {
      nameErrors () {
        const errors = []
        if (!this.$v.name.$dirty) return errors
        !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.name.required && errors.push('Name is required.')
        return errors
      },
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
      passwordErrors () {
        const errors = []
        if(!this.$v.password.$dirty) return errors
        !this.$v.password.required && errors.push('Password is required')
        !this.$v.password.minLength && errors.push('Password must be at least 8 characters long')
        return errors
      }
    },

    methods: {

      submit() {
        let Data = new FormData()
        Data.append('name', this.name)
        Data.append('email', this.email)
        Data.append('password', this.password)
        Data.append('role', this.role)
        axios.post('http://stage.test/admin/users', Data)
        .then(Response => {
          if (Response.status === 200) {
            this.open = false,
            this.$emit('force-render')
          }
        })
      }
    },

    created() {
      axios.get('http://stage.test/admin/users/roles')
      .then(Response => {
        this.items = Response.data
      })
    }
  }
</script>