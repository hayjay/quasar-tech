<template>
    <div class="q-pa-md">
        <form @submit.prevent.stop="onSubmit" @reset.prevent.stop="onReset" class="q-gutter-md">
            <q-input
            ref="task_name"
            filled
            v-model="task_name"
            label="Task Name *"
            hint="Name of the task you want to create."
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'Please type something']"
            ></q-input>

            <q-input
            ref="description"
            filled
            v-model="description"
            label="Task Description *"
            hint="Please type a description of this task."
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'Please type something']"
            ></q-input>
    
            <q-select
            ref="status"
            filled
            v-model="status"
            label="Your status *"
            :options="['LOW', 'HIGH', 'MEDIUM']"
            lazy-rules
            :rules="[
                val => val !== null && val !== '' || 'Please select a status',
            ]"
            ></q-select>
    
            <div>
            <q-btn label="Submit" type="submit" color="primary" ></q-btn>
            <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" ></q-btn>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'Add',
    
    data () {
        return {
            task_name: null,
            description: null,
            status: null,
        }
    },
    methods: {
        ...mapActions({
            storeTodoList: 'TodoList/create'
        }),

        async onSubmit () {
            this.$refs.task_name.validate()
            this.$refs.description.validate()
            this.$refs.status.validate()

            if (this.$refs.task_name.hasError || this.$refs.description.hasError || this.$refs.status.hasError) {
                this.formHasError = true
            }
            else {
                let formData = {
                    'name' : this.task_name,
                    'description' : this.description,
                    'status' : this.status
                };
                await this.storeTodoList(formData).then(response => {
                    let data = response.data[0];
                    if (data.status == true) {
                        this.$q.notify({
                            icon: 'done',
                            color: 'positive',
                            message: data.message
                        });
                        this.onReset();
                        this.$router.push('all')
                    } else{
                        this.$q.notify({
                            icon: 'report_problem',
                            color: 'negative',
                            message: `Something went wrong ${data.message}`
                        })
                    }
                }).catch(error => { 
                    console.log(error) 
                    this.$q.notify({
                        icon: 'report_problem',
                        color: 'negative',
                        message: `Something went wrong ${error}`
                    })
                });
                
            }
        },

        onReset () {
            this.task_name = null
            this.description = null
            this.status = null

            this.$refs.task_name.resetValidation()
            this.$refs.description.resetValidation()
            this.$refs.status.resetValidation()
        }
    }
}
</script>