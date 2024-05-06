<template>
    <div class="container mt-3">
        <i class="fa fa-search"></i>
        <input class="mb-3" type="text" placeholder="Search by item name" v-model="search" @keyup="searching()">
        <table class="table">
        <thead>
            <tr>
                <th scope="col" class="table-primary">Item_Name</th>
                <th scope="col" class="table-primary">Price</th>
                <th scope="col" class="table-primary">Description</th>
                <th scope="col" class="table-primary">Image</th>
                <th scope="col" class="table-primary">Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items.data" :key="item.id" v-show="search == ''">
                <td>{{ item.item_name }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.description }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImageModal" @click="getImage(item.image)">
                        Image
                    </button>
                </td>
                <td>
                    <a class="" :href="'/item_detail/' +item.id">
                        <button type="button" class="btn btn-info">
                            Detail Page
                        </button>
                    </a>
                </td>
            </tr>
            <tr v-for="item in search_items.data" :key="item.id" v-show="search != ''">
                <td>{{ item.item_name }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.description }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImageModal" @click="getImage(item.image)">
                        Image
                    </button>
                </td>
                <td>
                    <a class="" :href="'/item_detail/' +item.id">
                        <button type="button" class="btn btn-info">
                            Detail Page
                        </button>
                    </a>
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
                edit_image : null,
                })
            }
        },
        methods:{
            load_items(){
                axios.get('/user/get_items').then(({data}) => (this.items = data));
            },
            getResults(page = 1) {
                axios.get('/user/get_items?page=' + page)
                .then(response => {
                    this.items = response.data;
                });
            },
            getImage(item){
                this.image = item
            },
            handle_image(element){
                let file = element.target.files[0];
                let reader = new FileReader();
                reader.onloadend = (file)=> {
                    this.form.edit_image = reader.result;
                }
                reader.readAsDataURL(file);  
            },
            searching(){
                let query = this.search
                axios.get('/user/search_item?q=' + query)
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
