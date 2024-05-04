<template>
    <div class="container mt-3">
        <i class="fa fa-search"></i>
        <input class="mb-3" type="text" placeholder="Search by item name" v-model="search" @keyup="searching()">
        <table class="table">
        <thead>
            <tr>
                <th scope="col" class="table-primary">ID</th>
                <th scope="col" class="table-primary">Item_Name</th>
                <th scope="col" class="table-primary">Price</th>
                <th scope="col" class="table-primary">Description</th>
                <th scope="col" class="table-primary">Image</th>
                <th scope="col" class="table-primary">Status</th>
                <th scope="col" class="table-primary">Edit / Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items.data" :key="item.id" v-show="search == ''">
                <td>{{ item.id }}</td>
                <td>{{ item.item_name }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.description }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImageModal" @click="getImage(item.image)">
                        Image
                    </button>
                </td>
                <td>{{ item.status }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#EditModal" @click="EditItem(item)">
                        Edit
                    </button> /
                    <button type="button" class="btn btn-danger" @click="DeleteItem(item)" v-show="item.status == 'available'">
                        Delete
                    </button>
                    <button type="button" class="btn btn-warning" @click="RestoreItem(item)" v-show="item.status == 'deleted'">
                        Restore
                    </button>
                </td>
            </tr>
            <tr v-for="item in search_items.data" :key="item.id" v-show="search != ''">
                <td>{{ item.id }}</td>
                <td>{{ item.item_name }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.description }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImageModal" @click="getImage(item.image)">
                        Image
                    </button>
                </td>
                <td>{{ item.status }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#EditModal" @click="EditItem(item)">
                        Edit
                    </button> /
                    <button type="button" class="btn btn-danger" @click="DeleteItem(item)" v-show="item.status == 'available'">
                        Delete
                    </button>
                    <button type="button" class="btn btn-warning" @click="RestoreItem(item)" v-show="item.status == 'deleted'">
                        Restore
                    </button>
                </td>
            </tr>
            <div v-show="search == ''">
                <Bootstrap5Pagination
                    :data="items"
                    @pagination-change-page="getResults"
                />
            </div>
            
        </tbody>
        </table>
    </div>

    <!-- image modal -->
    <div class="modal" tabindex="-1" id="ImageModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img :src="'/images/'+image" class="rounded float-left pt-3 mb-3" width="100%" height="400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal" tabindex="-1" id="EditModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="edit()">
                    <div class="mb-3 mt-3">
                        <label class="mb-1">Item Name</label>
                        <input type="text" class="form-control" v-model="form.item_name">
                        <div v-if="form.errors.has('item_name')" v-html="form.errors.get('item_name')"></div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="mb-1">Price</label>
                        <input type="text" class="form-control" v-model="form.price">
                        <div v-if="form.errors.has('price')" v-html="form.errors.get('price')"></div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="mb-1">Description</label>
                        <input type="text" class="form-control" v-model="form.description">
                        <div v-if="form.errors.has('description')" v-html="form.errors.get('description')"></div>
                    </div>
                    <div class="mb-3 mt-3">
                            <label class="mb-1">Image</label>
                            <input type="file" class="form-control" id="edit_image" @change="handle_image">
                            <div v-if="form.errors.has('edit_image')" v-html="form.errors.get('edit_image')"></div>
                    </div>
                    <div class="mb-3 mt-3">
                            <label class="mb-1">Model File</label>
                            <input type="file" class="form-control" id="model_file" @change="handle_file">
                            <div v-if="form.errors.has('model_file')" v-html="form.errors.get('model_file')"></div>
                    </div>
                    <button class="btn btn-info"type="submit">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


</template>

<script>
    
    import Form from 'vform'
    export default {
        data(){
            return{
                image : null,
                items : {},
                search : '',
                search_items : {},
                form : new Form({
                id : null,
                item_name : null,
                price : null,
                description : null,
                status : null,
                edit_image : null,
                model_file : null,
                })
            }
        },
        methods:{
            load_items(){
                axios.get('/get_items').then(({data}) => (this.items = data));
            },
            getResults(page = 1) {
                axios.get('/get_items?page=' + page)
                .then(response => {
                    this.items = response.data;
                });
            },
            getImage(item){
                this.image = item
            },
            EditItem(item){
                this.form.fill(item)
            },
            handle_image(element){
                let file = element.target.files[0];
                let reader = new FileReader();
                reader.onloadend = (file)=> {
                    this.form.edit_image = reader.result;
                }
                reader.readAsDataURL(file);  
            },
            handle_file(element){
                let file = element.target.files[0];
                let reader = new FileReader();
                reader.onloadend = (file)=> {
                    this.form.model_file = reader.result;
                }
                reader.readAsDataURL(file);  
            },
            edit(){
                this.form.post('/edit_item')
                .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Item Updated Successfully'
                })
                if(this.search == ''){
                    this.load_items();
                }else{
                    this.searching();
                }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps!',
                        text: 'Something went wrong',
                    })
                })
            },
            DeleteItem(item){
            Swal.fire({
              title: 'Delete Item!',
              text: "Are you sure?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete item!'
            }).then((result) => {
              if (result.value) {
                this.form.fill(item)
                this.form.post('/delete_item')
                .then(() =>{
                  Toast.fire({
                    icon: 'success',
                    title: 'Item Delete Success'
                  })
                if(this.search == ''){
                    this.load_items();
                }else{
                    this.searching();
                }
                })
                .catch((error) => {
                  if(error.response.status == 403){
                        Swal.fire({
                        icon: 'error',
                        title: 'Opps',
                        text: 'Someting went wrong!',
                        })
                    }
                })
              } 
            })
            },
            RestoreItem(item){
            Swal.fire({
              title: 'Restore Item!',
              text: "Are you sure?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, restore item!'
            }).then((result) => {
              if (result.value) {
                this.form.fill(item)
                this.form.post('/restore_item')
                .then(() =>{
                  Toast.fire({
                    icon: 'success',
                    title: 'Item Restore Success'
                  })
                    if(this.search == ''){
                        this.load_items();
                    }else{
                        this.searching();
                    }
                })
                .catch((error) => {
                  if(error.response.status == 403){
                        Swal.fire({
                        icon: 'error',
                        title: 'Opps',
                        text: 'Someting went wrong!',
                        })
                    }
                })
              } 
            })
            },
            searching(){
                let query = this.search
                axios.get('/search_item?q=' + query)
                .then((data) =>{
                    this.search_items = data.data
                })
                .catch(() =>{
                })
            },
        },
        created(){
            this.load_items();
        },
    }
    
</script>
