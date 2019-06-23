<template>
    <div class="container">
        <div class="row mt-2">
          <div class="col-12">
            <div v-if="!$gate.isAdminOrAuthor()"><not-found></not-found></div>
            <div class="card" v-if="$gate.isAdminOrAuthor()">
              <div class="card-header">
                <h3 class="card-title">User Information Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal()" data-target="#newUser">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Eamil</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | capitalize}}</td>
                    <td><span class="tag tag-success">{{user.created_at | mydate}}</span></td>
                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        ||
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
                
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

<!-- modal ------------------ -->
<form @submit.prevent="editMode ? editUser() : createUser()">
        <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="editMode" class="modal-title" id="exampleModalCenterTitle">Update User</h5>
                    <h5 v-show="!editMode" class="modal-title" id="exampleModalCenterTitle">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 
                   <div class="form-group">
                      <label>User Name</label>
                      <input v-model="form.name" type="text" name="name"
                        placeholder="Enter Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                      <label>User Email</label>
                      <input v-model="form.email" type="text" name="email"
                        placeholder="Enter Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>
                     <div class="form-group">
                      <label>User Bio</label>
                      <input v-model="form.bio" type="text" name="bio"
                        placeholder="Enter Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                      <has-error :form="form" field="bio"></has-error>
                    </div>
                    
                  <div class="form-group">
                      <label>User type</label>
                      <select name="type" id="type" v-model="form.type" class="form-control" 
                      :class="{ 'is-invalid': form.errors.has('type') }">
                        
                        <option value="admin">Admin</option>
                        <option value="user">Standard User</option>
                        <option value="author">Author</option>
                      </select>
                      
                      <has-error :form="form" field="type"></has-error>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input v-model="form.password" type="password" name="password"
                        placeholder="Enter Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                      <has-error :form="form" field="password"></has-error>
                    </div>

                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                    <button v-show="!editMode" type="submit" class="btn btn-success">Create</button>
                </div>
                </div>
               
            </div>
            </div>
             </form>
    </div>
    
</template>

<script>
    export default {
      data(){
        return{
          editMode : false,
          users : {},
          form : new Form({
            id : '',
            name : '',
            email : '',
            password : '',
            type : '',
            bio : '',
            photo : ''
          })
        }
      },
      methods:{
        getResults(page = 1) {
                axios.get('api/user?page=' + page)
                  .then(response => {
                    this.users = response.data;
                  });
              },
        newModal(){
          this.form.reset();
           $('#newUser').modal('show');
           this.editMode = false;
        },
        editModal(user){
          this.editMode = true;
          this.form.reset();
           $('#newUser').modal('show');
           this.form.fill(user);
          
        },
        editUser(){
          // this.form.clear();
            //console.log('edit ing');
            this.$Progress.start();
            this.form.put('api/user/'+this.form.id)
            .then(()=>{
               $('#newUser').modal('hide')
                toast.fire({
                  type: 'User Update',
                  title: 'User Update successfully'
                });
               
                Fire.$emit('RefreshAction');
                this.$Progress.finish()
            }).catch(()=>{

              this.$Progress.fail();
            })
        },
        deleteUser(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            
            // Send ajax request
             if (result.value) {
            this.form.delete('api/user/'+id).then(()=>{
                
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              Fire.$emit('RefreshAction');
            }).catch(()=>{
               Swal.fire(
                  'Faild!',
                  'Your file has nor deleted. Some thing may wrong',
                  'warning'
                )
            })
          }
          })
      },
        showUser(){
          if(this.$gate.isAdminOrAuthor()){
          axios.get('api/user').then(({data}) => (this.users = data));

          }
        },
        createUser(){
          this.$Progress.start()
          this.form.post('api/user')
          .then(()=>{
              Fire.$emit('RefreshAction');
          //  if(ck == true){
              toast.fire({
              type: 'success',
              title: 'User Created successfully'
            });
            $('#newUser').modal('hide')
            
            this.$Progress.finish()
          // }
          })
         
         
        }
      },
        created() {
          Fire.$on('searching',()=>{
            let query = this.$parent.search;
            axios.get('api/findUser?q=' + query)
            .then((data)=>{
              this.users = data.data;
              //console.log('fuck uppp')
            }).catch(()=>{

            })
          })
            this.showUser()
            Fire.$on('RefreshAction',()=>{
              this.showUser();
            })
            //setInterval(() => this.showUser(), 3000);
        }
    }
</script>
