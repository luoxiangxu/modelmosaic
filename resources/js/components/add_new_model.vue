<template>
    <div class="container-fluid">
        <div class="row">
                <div class="col-sm-4 mt-3">
                </div>
                <div class="col-sm-4 mt-3">
                    <form @submit.prevent="add()">
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
                            <input type="file" class="form-control" id="image" @change="handle_image">
                            <div v-if="form.errors.has('image')" v-html="form.errors.get('image')"></div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="mb-1">Model File</label>
                            <input type="file" class="form-control" id="model_file" @change="handle_file">
                            <div v-if="form.errors.has('model_file')" v-html="form.errors.get('model_file')"></div>
                        </div>
                        <button class="btn btn-secondary"type="submit">Add</button>
                    </form> 
                </div>
                <div class="col-sm-4 mt-3">
                </div>
        </div>
    </div> 
</template>


<script>
import Form from 'vform'
export default {
    data(){
        return{
            form : new Form({
                item_name : null,
                price : null,
                description : null,
                image : null,
                model_file : null,
            })
        }
    },
    methods:{
        handle_image(element){
                let file = element.target.files[0];
                let reader = new FileReader();
                reader.onloadend = (file)=> {
                    this.form.image = reader.result;
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
        add(){
            this.form.post('/add_new_item')
            .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Item added successfully!'
                })
                this.form.reset();
                image.value = null;
                }).catch((error) => {
                    if(error.response.status == 403){
                        Swal.fire({
                        icon: 'error',
                        title: 'Opps',
                        text: 'Something wrong, please refresh',
                        })
                    }
            })
        }
    },
}
</script>