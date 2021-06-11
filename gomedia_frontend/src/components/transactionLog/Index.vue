<template>
    <div class="q-pa-md">
        <q-table
            title="Added Lists"
            :data="data"
            :columns="columns"
            row-key="name"
            :pagination.sync="pagination"
        >
            <q-td slot="body-cell-fieldName" slot-scope="props" :props="props">
                <q-field :error="$v.form.$each[props.row.__index].fieldName.$error"
                                :error-label="errorMsg($v.form.$each[props.row.__index].fieldName)">
                                <q-input type="text" v-model="props.row.fieldName" maxLength=9
                                @blur="$v.form.$each[props.row.__index].fieldName.$touch()" 
                                @change.native="changedField(props)" />
                </q-field>
            </q-td>
		</q-table>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'Index',
    
    data () {
      return {
        pagination: {
          sortBy: 'name',
          descending: false,
          page: 2,
          rowsPerPage: 10,
          rowsNumber: 5//xx since we are getting this data from the server
        },
        todo_list_data : [],
        columns: [
          {
            name: 'name',
            required: true,
            label: 'Name',
            align: 'left',
            field: row => row.name,
            format: val => `${val}`,
            sortable: true
          },
          { name: 'description', align: 'center', label: 'Description', field: 'description', sortable: true },
          { name: 'status', align: 'center', label: 'Status', field: 'status', sortable: true },
        ],
        data : this.getTodoList(),
      }
    },
    methods : {
      ...mapActions({
            fetchTodoList: 'TodoList/all'
      }),

      getTodoList() {
        var result = [];
        this.fetchTodoList().then(response => {
          if (response[0].data.status == false) {
              this.$q.notify({
                  icon: 'report_problem',
                  color: 'negative',
                  message: `Something went wrong ${data.message}`
              })
          }

          for(let data of response[0].data) {
            result.push(data);
          }
          
        }).catch(error => {

          this.$q.notify({
              icon: 'report_problem',
              color: 'negative',
              message: `An error occured while fetching todo list. ${error}`
          });
        });
        return result;
      } 
    },
}
</script>