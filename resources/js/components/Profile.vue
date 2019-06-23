<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
   
}
</style>


<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url(./img/photo2.png);">
                <h3 class="widget-user-username">{{this.form.name}}</h3>
                <h5 class="widget-user-desc">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProflePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                   
                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                          <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
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
                        <label for="inputName2" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">
                          <input type="file" @change="uploadProImg" class="form-control" id="profilePhoto" placeholder="form.photo">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Bio</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Bio"></textarea>
                        </div>
                      </div> -->
                       <div class="form-group">
                        <label>Password</label>
                        <input v-model="form.password" type="password" name="password"
                          placeholder="Enter Password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" @click.prevent="UpdateProInfo">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
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
        methods : {
          getProflePhoto(){
            let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile_img/"+this.form.photo;
            return photo;
          },
          UpdateProInfo(){
              this.form.put('api/profile')
              .then(()=>{
                this.$Progress.start()
                //this.form.reset()
                Fire.$emit('RefreshAction');

                this.$Progress.finish()
        
              }).catch(()=>{
                this.$Progress.fail()
              })
          },
          uploadProImg(element){
            let file = element.target.files[0];
           // console.log(file);
            //console.log(typeof(file['size']));
            if(file['size'] < 2097152){
                let reader = new FileReader();

                reader.onloadend = ()=>{
                // console.log('resut',reader.result)
                this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }else{
              Swal.fire(
                  'error',
                  'Your file has been under 2 MB',
                  'warning'
                )
            }
            
          }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            axios.get('api/profile')
            .then(({data}) => (this.form.fill(data)))
           
        }

    }
</script>
