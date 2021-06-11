<template>
    <div class="q-pa-md">
        <q-table
            title="Added Lists"
            :data="data"
            :columns="columns"
            row-key="name"
            :pagination.sync="pagination"
            binary-state-sort
        >
            <q-td slot="body-cell-fieldName" slot-scope="props" :props="props">
                <q-field :error="$v.form.$each[props.row.__index].fieldName.$error"
                                :error-label="errorMsg($v.form.$each[props.row.__index].fieldName)">
                                <q-input type="text" v-model="props.row.fieldName" maxLength=9
                                @blur="$v.form.$each[props.row.__index].fieldName.$touch()" 
                                @change.native="changedField(props)" />
                </q-field>
            </q-td>

            <template v-slot:top>
                
              <div class="q-pa-sm q-gutter-sm">
                <q-dialog v-model="show_dialog">
                  <q-card>
                    <q-card-section>
                      <div class="row">
                        <q-input v-model="editedItem.name" label="Name"></q-input>
                        <q-input v-model="editedItem.description" label="Description"></q-input>
                        <q-input v-model="editedItem.status" label="Status"></q-input>
                      </div>
                    </q-card-section>

                    <q-card-actions align="right">
                      <q-btn flat label="OK" color="primary" v-close-popup></q-btn>
                    </q-card-actions>
                  </q-card>
                </q-dialog>
              </div>
              
            </template>


            <template v-slot:body="props">
              <q-tr :props="props">
                <q-td key="name" :props="props">
                  {{ props.row.name }}
                  <q-popup-edit v-model="props.row.name">
                    <q-input v-model="props.row.name" dense autofocus counter ></q-input>
                  </q-popup-edit>
                </q-td>
                <q-td key="description" :props="props">
                  {{ props.row.description }}
                  <q-popup-edit v-model="props.row.calories" title="Update calories" buttons>
                    <q-input type="number" v-model="props.row.calories" dense autofocus ></q-input>
                  </q-popup-edit>
                </q-td>
                <q-td key="status" :props="props">
                  <div class="text-pre-wrap">{{ props.row.status }}</div>
                  <q-popup-edit v-model="props.row.fat">
                    <q-input type="textarea" v-model="props.row.fat" dense autofocus ></q-input>
                  </q-popup-edit>
                </q-td>
                <q-td key="actions" :props="props">
                  <q-btn color="blue" label="Update" @click="editItem(props.row)" size=sm no-caps></q-btn>
                  <q-btn color="red" label="Delete"  @click="deleteItem(props.row)" size=sm no-caps></q-btn>
                </q-td>
              </q-tr>
            </template>
		</q-table>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'Index',
    
    data () {
      return {
        show_dialog: false,
        editedIndex: -1,
        editedItem: {
          name: "",
          description: "",
          status: "",
        },
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
          {
            name: "actions",
            label: "Actions",
            field: "actions"
          }
        ],
        data : this.getTodoList(),
      }
    },
    methods : {
      deleteItem(item) {
        const index = this.data.indexOf(item);
        confirm("Are you sure you want to delete this todo list?") &&
          this.deleteTodo(item.id).then(response => {
            console.log(response)
            if (response[0].status == false) {
                this.$q.notify({
                    icon: 'report_problem',
                    color: 'negative',
                    message: `Something went wrong ${data.message}`
                })
            }else{
              this.data.splice(index, 1);
              this.$q.notify({
                  icon: 'done',
                  color: 'positive',
                  message: response[0].message
              });
            }
          
        }).catch(error => {

          this.$q.notify({
              icon: 'report_problem',
              color: 'negative',
              message: `An error occured while fetching todo list. ${error}`
          });
        });
      },
      editItem(item) {
        this.editedIndex = this.data.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.show_dialog = true;
      },
      close () {
        this.show_dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },
      
      ...mapActions({
            fetchTodoList: 'TodoList/all',
            deleteTodo: 'TodoList/deleteTodo',
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