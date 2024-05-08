<template>
    <div class="container-fluid">
        <div class="row mt-3">
                <div class="col-sm-3 mt-3">
                </div>
                <div class="col-sm-6 mt-3">
                    <h2><u>Comment Section</u></h2>
                    <div class="mb-3" v-for="comment in comments.data" :key="comment.id">
                        <label class="form-label"><span><strong>{{comment.user_name}}</strong></span> said: <span><em>{{comment.comment}}</em></span></label>
                    </div>
                    <div class="mb-3" v-show="comments.data == ''">
                        <label for="exampleFormControlInput1" class="form-label">No Comment Yet</label>
                    </div>
                    <Bootstrap5Pagination
                        :data="comments"
                        @pagination-change-page="getResults"
                    />
                </div>
                <div class="col-sm-3 mt-3">
                    <vue-login />
                </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="CommentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Post Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="post()">
                        <div class="mb-3 mt-3">
                            <label class="mb-1">Content</label>
                            <input type="text" class="form-control" v-model="form.comment" placeholder="Add a commment">
                            <div v-if="form.errors.has('comment')" v-html="form.errors.get('comment')"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Post</button>
                        </div>
                    </form> 
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
            comments : {},
            form : new Form({
                comment : null,
            })
        }
    },
    methods:{
        load_comment(){
            axios.get('/get_comments').then(({data}) => (this.comments = data));
        },
        getResults(page = 1) {
                axios.get('/get_comments?page=' + page)
                .then(response => {
                    this.comments = response.data;
                });
        },
        post(){
            this.form.post('/post_comment')
            .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Comment Posted Successfully!'
                })
                this.form.reset();
                this.load_comment();
                }).catch((error) => {
                    if(error.response.status == 400){
                        Swal.fire({
                        icon: 'error',
                        title: 'Opps',
                        text: 'You have to buy the product to post comment',
                        })
                    }else if(error.response.status == 401){
                        Swal.fire({
                        icon: 'error',
                        title: 'Opps',
                        text: 'You have to login to post the comment',
                        })
                    }
            })
        }
    },
    created(){
        this.load_comment();
    },
}
</script>
