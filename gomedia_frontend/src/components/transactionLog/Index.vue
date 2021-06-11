<template>
    <div class="q-pa-md">
        <q-table
            title="Transaction Logs"
            :data="data"
            :columns="columns"
            row-key="name"
            :pagination.sync="pagination"
        >
        <div class="col-3">
        <q-input  dense debounce="400" color="primary">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        </div> 
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
            name: 'description',
            required: true,
            label: 'Description',
            align: 'left',
            field: row => row.description,
            format: val => `${val}`,
            sortable: true
          },
          { name: 'ip_address', align: 'center', label: 'IP Address', field: 'ip_address', sortable: true },
          { name: 'payload', align: 'center', label: 'Payload', field: 'payload', sortable: true },
        ],
        data : this.getTransactionLog(),
      }
    },
    methods : {
      ...mapActions({
            fetchTransactionLog: 'TransactionLog/all'
      }),

      getTransactionLog() {
        var result = [];
        this.fetchTransactionLog().then(response => {
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
              message: `An error occured while fetching transaction logs : ${error}`
          });
        });
        return result;
      },
    },
}
</script>