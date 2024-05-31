<script>
import Layout from "../../pages/Layout.vue";

import axios from "axios";
import Swal from "sweetalert2";
import { mapActions } from "vuex";

export default {
  components: {
    Layout,
  },

  data() {
    return {
      imageUrl: null,
      name: this.$store.state.name,
      email: this.$store.state.email,
      phone: this.$store.state.phone,
      address: this.$store.state.address,

      formData: new FormData(),
    };
  },

  ...mapActions(["storeUserData"]),

  methods: {
    uploadImage(event) {
      const file = event.target.files[0];
      this.imageUrl = URL.createObjectURL(file);

      console.log(this.imageUrl);

      this.formData.append("image", file);
    },

    sendData() {
      const data = {
        // Your data to send to the API
        name: this.name,
        email: this.email,
        address: this.address,
        phone: this.phone,
      };

      const token = this.$store.state.token;

      //console.log(this.formData.get('name'));

      axios
        .post("https://appinventory.shuvobhowmik.xyz/api/profile-setting", this.formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            Authorization: `Bearer ${token}`,
          },
          params: data,
        })

        .then((response) => {
          console.log(response.data);

          const { token, phone, name, address, avatar, email, top_customer, out_of_stock } = response.data;
          this.$store.dispatch("storeUserData", {
            token,
            phone,
            name,
            address,
            avatar,
            email,
            top_customer,
            out_of_stock
          });

          Swal.fire({
            toast: true,
            position: "top-right",
            animation: true,
            text: response.data.message,
            icon: "success",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        })

        .catch((error) => {
          this.errorMessage = error.response.data.message;
          console.log(this.errorMessage);

          Swal.fire({
            toast: true,
            position: "top-right",
            animation: true,
            text: this.errorMessage,
            icon: "error",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        });
    },
  },
};
</script>

<template>
  <div>
    <Layout />
    <div class="page-wrapper">
      <div class="page-content">
        <div>
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    User Profile
                  </li>
                </ol>
              </nav>
            </div>
            <div class="ms-auto">
              <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button
                  type="button"
                  class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                  data-bs-toggle="dropdown"
                >
                  <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div
                  class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"
                >
                  <a class="dropdown-item" href="javascript:;">Action</a>
                  <a class="dropdown-item" href="javascript:;"
                    >Another action</a
                  >
                  <a class="dropdown-item" href="javascript:;"
                    >Something else here</a
                  >
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:;"
                    >Separated link</a
                  >
                </div>
              </div>
            </div>
          </div>
          <!--end breadcrumb-->
          <div class="container">
            <div class="main-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex flex-column align-items-center text-center"
                      >
                        <img
                          v-if="$store.state.avatar"
                          :src="
                            'https://appinventory.shuvobhowmik.xyz/images/' +
                            $store.state.avatar
                          "
                          
                          class="rounded-circle p-1 bg-primary"
                          width="110"
                          height="110"
                        />
                        <img
                          v-else
                          :src="
                            require('../../../assets/images/avatars/avatar-2.png')
                          "
                          :alt="AltText"
                          class="rounded-circle p-1 bg-primary"
                          width="110"
                          height="110"
                        />

                        <div class="mt-3">
                          <h4>{{ this.$store.state.name }}</h4>
                          <p class="text-secondary mb-1">
                            {{ this.$store.state.email }}
                          </p>
                          <p class="text-muted font-size-sm">
                            {{ this.$store.state.address }}
                          </p>
                          <button class="btn btn-primary">Follow</button>
                          <button
                            class="btn btn-outline-primary"
                            style="margin-left: 10px"
                          >
                            Message
                          </button>
                        </div>
                      </div>
                      <hr class="my-4" />
                      <ul class="list-group list-group-flush">
                        <li
                          class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                        >
                          <h6 class="mb-0">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              class="feather feather-globe me-2 icon-inline"
                            >
                              <circle cx="12" cy="12" r="10"></circle>
                              <line x1="2" y1="12" x2="22" y2="12"></line>
                              <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"
                              ></path></svg
                            >Website
                          </h6>
                          <span class="text-secondary"
                            >https://codervent.com</span
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8">
                  <div class="card">
                    <form
                      @submit.prevent="sendData"
                      enctype="multipart/form-data"
                    >
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Name</h6>
                          </div>

                          <div class="col-sm-9 text-secondary">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter your name"
                              v-model="name"
                            />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>

                          <div class="col-sm-9 text-secondary">
                            <input
                              type="email"
                              class="form-control"
                              placeholder="Enter your mail"
                              v-model="email"
                            />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                          </div>

                          <div class="col-sm-9 text-secondary">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter your phone"
                              v-model="phone"
                            />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                          </div>

                          <div class="col-sm-9 text-secondary">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter your address"
                              v-model="address"
                            />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Upload Image</h6>
                            <img src="" />
                          </div>

                          <div class="col-sm-9 text-secondary">
                            <input
                              type="file"
                              class="form-control"
                              @change="uploadImage"
                            />

                            <img
                              v-if="imageUrl"
                              :src="imageUrl"
                              alt="Preview"
                              style="
                                width: 120px;
                                height: 120px;
                                border-radius: 10px;
                                margin-top: 20px;
                              "
                            />
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-9 text-secondary">
                            <input
                              type="submit"
                              class="btn btn-primary px-4"
                              value="Save Changes"
                            />
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>