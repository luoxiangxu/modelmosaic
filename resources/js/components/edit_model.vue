<template>
    <div class="container mt-3">
        <table class="table">
        <thead>
            <tr>
                <th scope="col" class="table-primary">ID</th>
                <th scope="col" class="table-primary">Item_Name</th>
                <th scope="col" class="table-primary">Price</th>
                <th scope="col" class="table-primary">Description</th>
                <th scope="col" class="table-primary">Image</th>
                <th scope="col" class="table-primary">status</th>
                <th scope="col" class="table-primary">Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items.data" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.item_name }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.description }}</td>
                <td>
                    <button type="button" class="btn btn-primary">
                        Image
                    </button>
                </td>
                <td>{{ item.status }}</td>
                <td>Edit / Delete</td>
            </tr>
            <Bootstrap5Pagination
                :data="items"
                @pagination-change-page="getResults"
            />
        </tbody>
        </table>
    </div>
</template>

<script>
    
    import Form from 'vform'
    export default {
        data(){
            return{
                image : null,
                items : {},
                form : new Form({
                id : null,
                item_name : null,
                price : null,
                description : null,
                status : null,
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
            
        },
        created(){
            this.load_items();
        },
    }
    
</script>
