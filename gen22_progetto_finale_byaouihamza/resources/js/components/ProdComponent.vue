<template>
    <div>
    

       <div >
       <button @click="loadCreateModal()" class="btn btn-primary btn-block mt-5">Add New Product</button>
         <table class="table">
             <thead>
               <tr>
                 <th>index</th>
                <th>ID</th>
                <th>sku</th>
                <th>Name</th>
                <th>Price</th>
                <th>availability</th>
                <th>discount</th>
                <!-- <th>Actions</th> -->
            </tr>
             </thead>
             <tbody>
               <tr v-for="(product, index) in products" :key="product.id">
                <td>{{ index }}</td>
                 <td>{{ product.id }}</td>
                  <td>{{ product.sku }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.availability }}</td>
                <td>{{ product.discount }}</td>
                 <td><button @click="loadUpdateModal(index)" class="btn btn-warning">Edit</button></td>
                 <td><button @click="deleteTask(index)" class="btn btn-danger">Delete</button></td>
               </tr>
             </tbody>
           </table>

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
                        <label>Sku</label>
                        <input type="text" class="form-control" v-model="product.sku">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                     <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                     <div class="form-group">
                        <label>Availability</label>
                        <input type="text" class="form-control" v-model="product.availability">
                    </div>
                     <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" v-model="product.discount">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button @click="closecre" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="createProduct()" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> 


        <!-- Create Modal -->
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error" >{{error}}</li>
                            </ul>
                        </div>

                         <div class="form-group">
                        <label>Sku</label>
                        <input type="text" class="form-control" v-model="new_update_product.sku">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="new_update_product.name">
                    </div>
                     <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="new_update_product.price">
                    </div>
                     <div class="form-group">
                        <label>Availability</label>
                        <input type="text" class="form-control" v-model="new_update_product.availability">
                    </div>
                     <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" v-model="new_update_product.discount">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button @click="closeupd" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="updateProduct" type="button" class="btn btn-primary">Save changes</button>
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

                product:{
                   sku: "", name: "", price: "", availability: "", discount: "",
                },
                products: {},
                products: [],
                new_update_product: [],
                uri: '/api/products/',
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
               
                this.new_update_product = this.products[index];

            },



            createProduct(){

                axios.post(this.uri, {sku: this.product.sku, name: this.product.name, price: this.product.price, availability: this.product.availability, discount: this.product.discount })

                        .then(response=>{

                         this.products = response.data;

                        this.resetData();
                         $("#create-modal").modal("hide");

                })
            },


            updateProduct(){

               axios.patch(this.uri + this.new_update_product.id, {

                   sku: this.new_update_product.sku,
                   name: this.new_update_product.name,
                   price: this.new_update_product.price,
                   availability: this.new_update_product.availability,
                   discount: this.new_update_product.discount,

               }).then(response =>{

                      $("#update-modal").modal("hide");
                    

               })

            },

            deleteTask(index){

                let confirmBox = confirm("Do you really want to delete this?");

                if(confirmBox == true){

                    axios.delete(this.uri + this.products[index].id)
                            .then(response=>{

                              this.$delete(this.products, index);
                               


                          }).catch(error=>{

                         console.log("Could not delete for some reason")
                    });

                }


            },

            loadTasks(){

                axios.get(this.uri).then(response=>{

                    this.products = response.data;
                    setTimeout(this.loadTasks, 1000);


                });

            },

            resetData(){

                this.product.sku = '';
                this.product.name = '';
                this.product.price = '';
                this.product.availability = '';
                this.product.discount = '';

            }


        },


        mounted() {
            this.loadTasks();
        }
    }
</script>
