<script>
import axios from "axios";
export default {
    name: "SignUpForm",
    data() {
        return {
            payload: {
                first_name: '',
                last_name: '',
                email: ''
            },
            errors: {
                first_name: '',
                last_name: '',
                email: '',
            },
            errors_show: {
                first_name: false,
                last_name: false,
                email: false,
            }
        }
    },
    methods: {
        submit() {
            axios.post('http://localhost:8080/user/create', this.$data.payload)
                .then((response) => {
                    for (let key in this.$data.errors) {
                        this.$data.errors[key] = '';
                        this.$data.errors_show[key] = false;
                    }
                    alert("User successfully registered!");
                }).catch((error) => {
                    if (error.response) {
                        if (error.response.status === 409) {
                            const errors = error.response.data['errors'];
                            for (let key in this.$data.errors) {
                                this.$data.errors[key] = errors[key] ?? '';
                                this.$data.errors_show[key] = !!errors[key];
                            }
                        } else {
                            alert("Unexpected error occurred.");
                        }
                    }
            });
        }
    }
}
</script>

<template>
  <form @submit.prevent="submit">
      <div class="input">
          <input type="text" v-model="payload.first_name" placeholder="First Name">
          <div ref="first_name_err" v-if="errors_show.first_name" class="error">{{errors.first_name}}</div>
      </div>
      <div class="input">
          <input type="text" v-model="payload.last_name" placeholder="Last Name">
          <div ref="last_name_err" v-if="errors_show.last_name" class="error">{{errors.last_name}}</div>
      </div>
      <div class="input">
          <input type="text" v-model="payload.email" placeholder="E-mail">
          <div ref="email_err" v-if="errors_show.email" class="error">{{errors.email}}</div>
      </div>
      <button type="submit">GO</button>
  </form>
</template>

<style scoped>
form {
    display: flex;
    flex-direction: column;
}
input {
    font-size: 15pt;
    min-width: 400px;
}
.input {
    margin-bottom: 10px;
}
.error {
    text-align: left;
    color: darkred;
}
</style>