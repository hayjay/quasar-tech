<template>
    <q-layout view="hHh lpR fFf">
        <q-page-container>
            <q-page class="home-page window-height window-width row justify-center items-center ">
                <div class="q-pa-lg">
                    <form @submit.prevent.stop="onSubmit" class="q-gutter-md">
                        <q-input
                        ref="email"
                        filled
                        v-model="userData.email"
                        label="Email Address *"
                        hint="Please enter your email."
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'This field is required']"
                        ></q-input>
                
                        <q-input
                        ref="password"
                        filled
                        v-model="userData.password"
                        label="Password *"
                        hint="Please enter your password."
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'This field is required']"
                        ></q-input>
                
                        <div>
                            <q-btn label="Submit" type="submit" color="primary" ></q-btn>
                        </div>
                    </form>
                </div>
            </q-page>
        </q-page-container>
</q-layout>
    
</template>

<script>
export default {
    name: 'Login',
    
    data () {
        return {
            userData : {
                email: null,
                password: null,
            }
        }
    },
    methods: {
        onSubmit () {
            // this.$refs.email.validate()
            // this.$refs.password.validate()

            if (this.$refs.email.hasError || this.$refs.password.hasError ) {
                this.formHasError = true
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/login', this.userData).then(response => {
                    let data = response.data;
                    if (data.data == "success") {
                        this.$q.notify({
                            icon: 'done',
                            color: 'positive',
                            message: `Login Successful!`
                        });
                        return this.$router.push('/dashboard');
                    }
                    this.$q.notify({
                        icon: 'report_problem',
                        color: 'negative',
                        message: `Invalid Login Credentials`,
                        timeout: 500
                    })
                }).catch(error => console.log(error)); // credentials didn't match
            });
            
            
        },
    }
}
</script>