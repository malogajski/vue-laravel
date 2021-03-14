<template>
    <div class="container">
        <h2 class="text-center p-2 text-white bg-primary mt-5">Add Contact</h2>


        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form name="validateForm" @submit.prevent="updateContact" enctype="multipart/form-data" novalidate>

                    <div class="aler alert-danger" v-if="errors.length">
                        <ul class="mb-0">
                            <li v-for="(error, index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter name"
                               v-model="contact.name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email"
                               v-model="contact.email">
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea type="text" id="bio" class="form-control" placeholder="Enter Bio"
                                  v-model="contact.bio"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="email" id="occupation" class="form-control" placeholder="Enter Occupation"
                               v-model="contact.occupation">
                    </div>

                    <div class="form-group">
                        <label for="contact_no">Contact Number</label>
                        <input type="email" id="contact_no" class="form-control" placeholder="Enter Contact Number"
                               v-model="contact.contact_no">
                    </div>

                    <div class="form-group" v-if="contact.image">
                        <img :src="`${url + '/' + contact.image}`" alt="image" style="max-height: 200px; width: auto">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="validatedCustomFile" v-on:change="onImageChange" >
                    </div>

                    <button class="btn-primary mt-4">Submit</button>

                </form>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    // name: "AddContact"

    data() {
        return {
            url: document.head.querySelector('meta[name="url"]').content,
            contact: [],
            name: '',
            email: '',
            bio: '',
            occupation: '',
            contact_no: '',
            errors: []
        }
    },
    methods: {
        localData() {
            let url = this.url + `/api/getContact/${this.$route.params.id}`;
                this.$http.get(url).then((response) => {
                    this.contact = response.data;
            });
        },
        updateContact() {
            this.errors = [];
            if (!this.contact.name) {
                this.errors.push('Name is required!');
            }
            if (!this.contact.email) {
                this.errors.push('Email is required!');
            }
            if (!this.contact.occupation) {
                this.errors.push('Occupation is required!');
            }
            if (!this.contact.bio) {
                this.errors.push('Bio is required!');
            }
            if (!this.contact.contact_no) {
                this.errors.push('Contact Number is required!');
            }

            if (!this.errors.length) {
                let formData = new FormData();
                formData.append('name', this.contact.name);
                formData.append('email', this.contact.email);
                formData.append('image', this.image);
                formData.append('occupation', this.contact.occupation);
                formData.append('bio', this.contact.bio);
                formData.append('contact_no', this.contact.contact_no);
                let url = this.url + `/api/updateContact/${this.$route.params.id}`;
                this.$http.post(url, formData).then((response) => {
                    if (response.status) {

                        this.$utils.showSuccess('success', response.message);
                        this.$router.push({
                            name: '/contacts'
                        });
                    } else {
                        this.$utils.showError('Error', response.message)
                    }
                }).catch(error => {
                    this.errors.push(error.response.data.error);
                });
            }
        },
        onImageChange(e) {
            this.image = e.target.files[0];
        }
    },
    created() {
        this.localData();
    },
    mounted: function () {
        console.log('Get Contact Component Loaded');
    }
}
</script>
