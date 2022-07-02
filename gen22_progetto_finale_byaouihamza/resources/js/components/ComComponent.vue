<template>
   
    

       <div class="container mt-4" >
       <button @click="loadCreateModal()" class="btn btn-primary btn-block my-3">Add New Comment</button>
             <div class="card my-3" v-for="(comment, index) in comments" :key="comment.id">                         	
                <div class="card-body">                         	
                    <h4 class="card-title">{{ comment.title }}</h4>   
                    <p class="card-text">{{ comment.description }}</p>
                 <div><button @click="deleteTask(index)" class="btn btn-danger">Delete</button></div>                 	
                </div>                     	
                </div>     
              

        <!-- Create Modal -->
         <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error">{{error}}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" v-model="comment.title">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control" v-model="comment.description">
                    </div>
    
                    <div class="modal-footer">
                        <button @click="closecre()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="createProduct()" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> 

     </div>
    </div>
</template>

<script>
    export default {
          

        data(){

            return {

                comment:{
                   title: "", description: "",
                },
                comments: {},
                comments: [],
                new_update_comment: [],
                uri: '/api/comments/',
                errors: [],
            
             
              

            }

        },

        methods: {
            closecre(){
                 $("#create-modal").modal("hide");
            },

            closeupd(){
                  $("#update-modal").modal("hide");
            },

            loadCreateModal(){

                $("#create-modal").modal("show");
            },

            loadUpdateModal(index){

                
                 $("#update-modal").modal("show");
               
                this.new_update_comment = this.comments[index];

            },



            createProduct(){

                axios.post(this.uri, {title: this.comment.title, description: this.comment.description })

                        .then(response=>{

                         this.comments = response.data;

                        this.resetData();
                         $("#create-modal").modal("hide");

                })
            },


            updateProduct(){

               axios.patch(this.uri + this.new_update_comment.id, {

                   title: this.new_update_comment.title,
                   description: this.new_update_comment.description,

               }).then(response =>{

                      $("#update-modal").modal("hide");
                    

               })

            },

            deleteTask(index){

                let confirmBox = confirm("Do you really want to delete this?");

                if(confirmBox == true){

                    axios.delete(this.uri + this.comments[index].id)
                            .then(response=>{

                              this.$delete(this.comments, index);
                               


                          }).catch(error=>{

                         console.log("Could not delete for some reason")
                    });

                }


            },

            loadTasks(){

                axios.get(this.uri).then(response=>{

                    this.comments = response.data;
                    setTimeout(this.loadTasks, 1000);
                });

            },

            resetData(){

                this.comment.title = '';
                this.comment.description = '';

            }


        },


        mounted() {
            this.loadTasks();
        }
    }
</script>
