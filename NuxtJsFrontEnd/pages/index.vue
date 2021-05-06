<template>
<b-container fluid="sm" class="bv-example-row">
  <b-row>
    <b-col>
      <h5>Personal Information</h5>
      <p>Use a permanent address where you can receive mail.</p>
    </b-col>
    <b-col cols="7">
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <b-row>
          <b-col>
            <b-form-group
              id="input-group-1"
              label="First name:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.firstname"
                type="text"
                placeholder="Enter First name."
                required
              ></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              id="input-group-1"
              label="Last name:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.lastname"
                type="text"
                placeholder="Enter Last name."
                required
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col>
            <b-form-group
              id="input-group-1"
              label="Email address:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.email"
                type="email"
                placeholder="Enter email"
                required
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col>
            <b-form-group id="input-group-3" label="Country / Region:" label-for="input-3">
            <b-form-select
              id="input-3"
              v-model="form.country"
              :options="countrys"
              required
            ></b-form-select>
          </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col>
            <b-form-group
              id="input-group-1"
              label="Street address:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.street"
                type="text"
                placeholder="Enter Street address."
                required
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col>
            <b-form-group
              id="input-group-1"
              label="City:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.city"
                type="text"
                placeholder="Enter City."
                required
              ></b-form-input>
            </b-form-group>
          </b-col>

          <b-col>
            <b-form-group
              id="input-group-1"
              label="State / Province:"
              label-for="input-1"
              description=""
            >
                <b-form-input
                  id="input-1"
                  v-model="form.state"
                  type="text"
                  placeholder="Enter State / Province."
                  required
                ></b-form-input>
            </b-form-group>
          </b-col>

          <b-col>
            <b-form-group
              id="input-group-1"
              label="Zip / Postal:"
              label-for="input-1"
              description=""
            >
              <b-form-input
                id="input-1"
                v-model="form.zip"
                type="text"
                placeholder="Enter Zip / Postal."
                required
              ></b-form-input>
          </b-form-group>
          </b-col>
        </b-row>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form></b-col>
  </b-row>
</b-container>
</template>

<script>
const axios = require('axios');
export default {
    data() {
      return {
        API_URL: 'http://localhost:8000/',
        form: {
          firstname: '',
          lastname: '',
          email: '',
          country: null,
          street: '',
          city: '',
          state: '',
          zip: '',
        },
        countrys: [{ text: 'Select One', value: null }, 'United State', 'India', 'Iceland', 'Indonesia'],
        show: true
      }
    },
    created() {
      var self = this;
      axios
      .get(self.API_URL+'api/getUser?token=0xff51afd7ed558ccdL')
      .then(function(response){
        self.form = response.data;
      });
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()
        var self = this;
        self.form.token = '0xff51afd7ed558ccdL';
        axios
        .post(self.API_URL+'api/updateUser?',self.form)
        .then(function(response){
          alert(response.data.message);
        });
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.firstname = ''
        this.form.lastname = ''
        this.form.email = ''
        this.form.street = ''
        this.form.city = ''
        this.form.state = ''
        this.form.country = null
        this.form.zip = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>

<style>

</style>
