<template>
    <div id="visitors">
      <div class="row justify-content-center">
        <div class="col-md-12">

          <div class="row add-refresh bg-white">
            <div class="col-md-4 card-header-left">
              <strong>
                <i class="fas fa-users"></i>
                Members List
            </strong>
            </div>

            <div class="col-md-8 card-header-right">
              
              <!-- We have used modal form to add new visitors here -->

              <!-- Button trigger modal -->
              <button type="button" @click="create()" class="bttn add-btn" data-toggle="modal">
              Add Member <i class="fas fa-user-plus ml-1"></i>
              </button>

              <button type="button" @click="reload()" class="bttn ml-1">
              Refresh Page<i class="fas fa-sync pl-2"></i>
              </button>
            </div>
          </div>

          <div class="row search-section">
            <div class="col-md-8 search-category">
              <strong>Search By :</strong>
              <div class="dropmenu">
                <div id="testButton">
                  <button class="selectButton" id="selectButton"><span>Select Category</span> 
                  <i class="fas fa-angle-down"></i></button>                  
                </div>

               <div class="ulist">
                    <label class="selectOption">Guest Name<input type="radio" class="radio" v-model = "queryField" value="guestName"></label>

                    <label class="selectOption">Guest Designation<input type="radio" class="radio" v-model = "queryField" value="guestDesignation"></label>

                    <label class="selectOption">Organization<input type="radio" class="radio" v-model = "queryField" value="guestOrg"></label>

                    <label class="selectOption">Car Number<input type="radio" class="radio" v-model = "queryField" value="carNumber"></label>
                  
               </div> 
                
              </div>
             
            </div>
            <div class="col-md-4 search-box">
                <div class="input-group">
                  <input v-model = "query" class="search form-control" type="search" placeholder="Search your query" aria-label="Search" >
                </div>
            </div>
          </div>

          
            <div class="row">
              <table v-if="loading" class="table table-bordered" style="border-radius: 3px 3px 0 0 !important">
              <thead class="table-header-section">
                <tr >
                  <th scope="col">#</th>
                  <th scope="col">Guest Name</th>
                  <th scope="col">Designation</th>
                  <th scope="col">Organization</th>
                  <th scope="col">Rest Room</th>
<!--                   <th scope="col">Protocol/Bodyguard</th> -->
                  <th scope="col">Car Number</th>
<!--                   <th scope="col">Messenger's Name</th>
                  <th scope="col">Messenger's Designation</th>
                  <th scope="col">Authorizer's Name</th>
                  <th scope="col">Authorizer's Designation</th> -->
                  <th scope="col">Visiting Date</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="visitors.length" v-for="(visitor, index) in visitors" :key="visitor.id">
                  <td>{{ visitor.id }}</td>
                  <td>{{ visitor.guestName}}</td>
                  <td>{{ visitor.guestDesignation}}</td>
                  <td>{{ visitor.guestOrg}}</td>
                  <td>{{ visitor.restroom}}</td>                <!-- <td>{{ visitor.bodyguardName}}</td>  -->
                  <td>{{ visitor.carNumber }}</td>
                 <!--  <td>{{ visitor.messengerName }}</td>
                  <td>{{ visitor.messengerDesignation }}</td>
                  <td>{{ visitor.authorizerName }}</td>
                  <td>{{ visitor.authorizerDesignation }}</td>  -->
                  <td>{{ visitor.visitingDate }}</td>
                  <td class="text-center">
                    <button type="button" @click="view(visitor)" class="btn-action btn-secondary btn-sm">
                      <i class="fas fa-eye"></i>
                      <span>View guest details</span>
                    </button>
                    <button type="button" @click="edit(visitor)" class="btn-action btn-edit btn-sm">
                      <i class="fas fa-edit"></i>
                      <span>Edit guest data</span>
                    </button>
                    <button type="button" @click="destroy(visitor)" class="btn-action btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                      <span>Delete this guest</span>
                    </button>
                  </td>
                </tr>
                 <tr v-if="loading" v-show="!visitors.length" class="text-center">
                  <td colspan="8">
                    <div class="empty">
                      <h4 class="text-danger">
                        No data found!
                      </h4>
                    </div>
                  </td>
                </tr> 
              </tbody>
          </table>
          <div v-else class="loading-pos">
                <button class="loading-btn" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
                </button>  
            </div>

         </div> 


           <!-- Modal -->
    <div class="modal fade" id="visitorsModal" tabindex="-1" role="dialog" aria-labelledby="visitorsModal" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="visitorsModalScrollableTitle"><strong v-if="editMode">Edit Information</strong><strong v-else-if="addMode">Add New Information</strong><strong v-else-if="view">Guest Detail</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          

          <!-- To show Visitors details view -->
          <div v-if="viewMode">
          <div class="modal-body">
              <div>
                <p><label for="guestName" class="">
                  Guest Name : 
                </label>

                 {{form.guestName}}</p>
              </div>
              

              <div class="form-group">
                  <p><label for="guestDesignation" class="">
                  Designation :
                  </label>
                  {{form.guestDesignation}}</p>
                 
              </div>
              

              

              <div class="form-group">
                <p>  <label for="guestOrg" class="">
                  Organization :
                </label>
                {{form.guestOrg}}</p>

                 
              </div>
              

              <div class="form-group">
                <p>  <label for="name" class="">
                  Visiting Date :
                </label>
                {{form.visitingDate}}</p>
                      
                      
              </div>
              

              <div class="form-group">
                <p>  <label for="restroom" class="">
                  Rest Room :
                </label>
                {{form.restroom}}</p>

                 
              </div>

              

              <div class="form-group">
                <p>  <label for="bodyguardName" class="">
                  Protocol/Bodyguard :
                </label>
                {{form.bodyguardName}}</p>

                 
              </div>

              

              <div class="form-group">
                <p>  <label for="carNumber" class="">
                  Car Number :
                </label>
                {{form.carNumber}}</p>

                               
                </div>

              

              <div class="form-group">
                <p>  <label for="messengerName" class="">
                  Messenger's Name :
                </label>
                {{form.messengerName}}</p>

                 
              </div>

                

              <div class="form-group">
                <p>  <label for="messengerDesignation" class="">
                  Messenger's Designation :
                </label>
                {{form.messengerDesignation}}</p>

                 
              </div>

              

              <div class="form-group">
                <p>  <label for="authorizerName" class="">
                  Authorizer's Name :
                </label>
                {{form.authorizerName}}</p>

                 
              </div>

              

              <div class="form-group">
                <p>  <label for="authorizerDesignation" class="">
                  Authorizer's Designation :
                </label>
                {{form.authorizerDesignation}}</p>

                 
              </div> 
              
                  
     

          </div>
          <div class="modal-footer">
            <button class="btn-modal-close" data-dismiss="modal">Close</button>
          </div>

          <!--End of view detail section-->
          </div>

          <form v-else @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form"></alert-error>
              <div class="form-group">
                <label for="guestName" class="">
                  Guest Name
                </label>

                 <input id="guestName" name="guestName" type="text" class="form-control" v-model="form.guestName" :class="{ 'is-invalid': form.errors.has('guestName') }">
                 <has-error :form="form" field="guestName"></has-error>
              </div>
              

              <div class="form-group">
                  <label for="guestDesignation" class="">
                  Designation
                  </label>

                 <input id="guestDesignation" name="guestDesignation" type="text" class="form-control" v-model="form.guestDesignation" :class="{ 'is-invalid': form.errors.has('guestDesignation') }">
                 <has-error :form="form" field="guestDesignation"></has-error>
              </div>
              

              

              <div class="form-group">
                  <label for="guestOrg" class="">
                  Organization
                </label>

                 <input id="guestOrg" name="guestOrg" type="text" class="form-control" v-model="form.guestOrg" :class="{ 'is-invalid': form.errors.has('guestOrg') }">
                 <has-error :form="form" field="guestOrg"></has-error>
              </div>
              

              <div class="form-group">
                  <label for="name" class="">
                  Visiting Date
                </label>
                <br>
                  <div class='input-group date' id='datetimepicker1'>
                      <input type='date' name="visitingDate" class="form-control" v-model="form.visitingDate" :class="{ 'is-invalid': form.errors.has('visitingDate') }">
                 <has-error :form="form" field="visitingDate"></has-error>
                      
                  </div>
              </div>
              

              <div class="form-group">
                  <label for="restroom" class="">
                  Rest Room
                </label>

                 <input id="restroom" type="text" name="restroom" class="form-control" v-model="form.restroom" :class="{ 'is-invalid': form.errors.has('restroom') }">
                 <has-error :form="form" field="restroom"></has-error>
              </div>

              

              <div class="form-group">
                  <label for="bodyguardName" class="">
                  Protocol/Bodyguard
                </label>

                 <input id="bodyguardName" name="bodyguardName" type="text" class="form-control" v-model="form.bodyguardName" :class="{ 'is-invalid': form.errors.has('bodyguardName') }">
                 <has-error :form="form" field="bodyguardName"></has-error>
              </div>

              

              <div class="form-group">
                  <label for="carNumber" class="">
                  Car Number
                </label>

                 <input id="carNumber" type="text" name="carNumber" class="form-control" v-model="form.carNumber" :class="{ 'is-invalid': form.errors.has('carNumber') }">
                 <has-error :form="form" field="carNumber"></has-error>              
                </div>

              

              <div class="form-group">
                  <label for="messengerName" class="">
                  Messenger's Name
                </label>

                 <input id="messengerName" name="messengerName" type="text" class="form-control" v-model="form.messengerName" :class="{ 'is-invalid': form.errors.has('messengerName') }">
                 <has-error :form="form" field="messengerName"></has-error>
              </div>

                

              <div class="form-group">
                  <label for="messengerDesignation" class="">
                  Messenger's Designation
                </label>

                 <input id="messengerDesignation" name="messengerDesignation" type="text" class="form-control" v-model="form.messengerDesignation" :class="{ 'is-invalid': form.errors.has('messengerDesignation') }">
                 <has-error :form="form" field="messengerDesignation"></has-error>
              </div>

              

              <div class="form-group">
                  <label for="authorizerName" class="">
                  Authorizer's Name
                </label>

                 <input id="authorizerName" name="authorizerName" type="text" class="form-control" v-model="form.authorizerName" :class="{ 'is-invalid': form.errors.has('authorizerName') }">
                 <has-error :form="form" field="authorizerName"></has-error>
              </div>

              

              <div class="form-group">
                  <label for="authorizerDesignation" class="">
                  Authorizer's Designation
                </label>

                 <input id="authorizerDesignation" type="text" name="authorizerDesignation" class="form-control" v-model="form.authorizerDesignation" :class="{ 'is-invalid': form.errors.has('authorizerDesignation') }">
                 <has-error :form="form" field="authorizerDesignation"></has-error>
              </div>
              
                  
     

          </div>
          <div class="modal-footer">

            <button :disabled="form.busy" type="submit" class="bttn ">{{ editMode ? "Save Changes" : "Add Member"}}</button>

             <button class="btn-modal-close" data-dismiss="modal">Close</button>
            <!-- <div class="save-btn col-md-5">
              
            </div>
            <div class="close-btn col-md-5">
             
            </div> -->
          </div>

          </form>      


        </div>
      </div>
    </div>
    <!-- End of modal form -->



          <pagination v-if="pagination.last_page > 1"
                      :pagination = "pagination"
                      :offset="3"
                      @paginate = "query === '' ? getData() : searchData()">
                        
          </pagination> 


   
      </div>
    </div>
    <vue-progress-bar></vue-progress-bar>
    <vue-snotify></vue-snotify>

    </div>
</template>

<script>
  
    export default {

      data() {
        return {
          editMode: false,
          addMode: false,
          viewMode: false,
          query: '',
          queryField: 'guestName',
          visitors: [],
          pagination: {
            current_page: 1
          },

           form: new Form({
            id: '',
            guestName: '',
            guestDesignation: '',
            guestOrg: '',
            restroom: '',
            bodyguardName: '',
            carNumber: '',
            messengerName: '',
            messengerDesignation: '',
            authorizerName: '',
            authorizerDesignation: '',
            visitingDate: ''
          }),

          loading: false
        }
      },

      watch: {
        query:function(newQuery, oldQuery){
          if(newQuery === ''){
            this.loading = false;
            this.pagination.current_page = 1;
            this.getData()
          } else{
            this.loading = false;
            this.pagination.current_page = 1;
            this.searchData();
          }
        }
      },

      mounted() {
        console.log('Component mounted.');
        this.getData();
      },

      methods: {
        getData(){
          this.$Progress.start()
          axios.get('/api/visitors?page='+this.pagination.current_page)
          .then(response => {
            this.visitors = response.data.data;
            this.pagination = response.data.meta;
            this.$Progress.finish();
            this.loading = true;
          })
          .catch(e => {
            console.log(e)
            this.$Progress.fail();
          })
        },

        searchData(){

          this.$Progress.start()
          axios.get('/api/search/visitors/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
          .then(response => {
            this.visitors = response.data.data;
            this.pagination = response.data.meta;
            this.$Progress.finish()
            this.loading = true;
          })
          .catch(e => {
            console.log(e);
            this.$Progress.fail()
          })
        },

        reload(){
          this.getData();
          this.query = '';
          this.queryField = 'guestName';

          this.$snotify.success('Data successfully refreshed', 'success')
          document.getElementById('selectButton').firstChild.innerText = 'Select Category'
        },

        create(){
          this.form.reset()
          this.form.clear()
          this.editMode = false;
          this.addMode = true;
          this.viewMode = false;
          $('#visitorsModal').modal('show');
        },


        store(){
            this.$Progress.start()
            this.form.busy = true

            this.form.post('/api/visitors')
            .then(response => {
              this.getData()
              $('#visitorsModal').modal('hide');
              if(this.form.successful)
              {
                this.$Progress.finish()
                this.$snotify.success('Guest Informations Saved!', 'Success')
              }else{
                this.$Progress.fail()
                this.$snotify.error('Something Went Wrong!', 'Error')
              }
            })
            .catch(e => {
              this.$Progress.fail()
              console.log(e)
            })
          },

          edit(visitor){
          this.editMode = true;
          this.addMode = false;
          this.viewMode = false;
            this.form.reset()
            this.form.clear()
            this.form.fill(visitor)
            $('#visitorsModal').modal('show');
          },
          update(){
            this.$Progress.start()
            this.form.busy = true

            this.form.put('/api/visitors/'+ this.form.id)
            .then(response => {
              this.getData()
              $('#visitorsModal').modal('hide');
              if(this.form.successful)
              {
                this.$Progress.finish()
                this.$snotify.success('Guest Informations Updated Successfully!', 'Success')
              }else{
                this.$Progress.fail()
                this.$snotify.error('Something Went Wrong!', 'Error')
              }
            })
            .catch(e => {
              this.$Progress.fail()
              console.log(e)
            })

          },
          view(visitor){
          this.editMode = false;
          this.addMode = false;
          this.viewMode = true;
          this.form.fill(visitor);
            $('#visitorsModal').modal('show');

          },
          destroy(visitor){
            this.$snotify.clear();
            this.$snotify.confirm(
              "You will not be able to recover this data!",
              "Are you sure!",
              {
                showProgressBar: false,
                closeOnclick: false,
                pauseOnHover: true,
                buttons: [
                {
                  text: "Yes",
                  action: toast => {
                    this.$snotify.remove(toast.id);
                    this.$Progress.start();
                    axios.delete('/api/visitors/'+visitor.id)
                    .then(esponse => {
                      this.getData();
                      this.$Progress.finish();
                      this.$snotify.success(
                        "Guest information deleted successfully!",
                        "Success"
                        );
                    })
                    .catch(e => {
                      this.$Progress.fail();
                      console.log(e);
                    })
                  },
                  bold: true
                },
                {
                  text: "No",
                  action: toast => {
                    this.$snotify.remove(toast.id);
                  },
                  bold: true
                }
                ]
              }
              );
          }
      }
    }
</script>
