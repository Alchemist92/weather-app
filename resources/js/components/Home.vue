<template>
    <div>        
        <!-- section Start -->
        <section class="vh-100 d-flex align-items-center" style="background: url('../assets/contact-detail.jpg') center center">
            <div class="bg-overlay bg-overlay-white"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-6 col-md-7 offset-md-5">  
                        <div v-if="weather" class="col-md-8 bg-dark text-white p-3 rounded mb-3 position-relative">                            
                            <div class="text-center">
                                <div class="close-btn bg-secondary text-dark px-1" @click.stop="clearResult">x</div>
                                <p class="lead">Current weather at {{ cityName }} says:  </p>
                                <p><i class="fas fa-cloud fa-2x text-white"></i></p>
                                <p class="p-2">{{ capitalize(weather)}}</p>
                            </div>
                        </div>  
                        <div v-if="errorMessage" class="col-md-8 alert alert-danger mb-3">
                            <div>
                                <p>{{ errorMessage }}</p>
                            </div>
                        </div>                         
                        <div class="row my-3">
                            <div class="col-md-12 my-3">
                                <h1 class="display-2">Welcome</h1><br>
                                <p class="small text-justify text-secondary">Please enter a city in the input box below to get wether information.</p>
                            </div>
                            <div class="col-md-8">
                                <form @submit.prevent="submitRequest" class="user">
                                    <div class="form-group mb-4">
                                        <input
                                            type="text"
                                            v-model="city"
                                            class="form-control"
                                            placeholder="Enter City..."
                                            required
                                        />
                                    </div>
                                    <div class="text-center">
                                        <button                             
                                            type="submit"
                                            class="btn btn-dark px-5 py-3"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>                                                    
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container--> 
        </section><!--end section-->   
    </div>
</template>

<script setup>
import {ref} from "vue";
import axios from "axios";


const city = ref('');
const weather = ref('');
const errorMessage = ref('');
const cityName = ref("");

const submitRequest  = () => {
    cityName.value = city.value;
    axios.get(`/api/city/${city.value}`)
    .then(({data: {data}}) => {        
        weather.value = data;
    })
    .catch(({ response: { data } }) => {        
      if(data){
        errorMessage.value = `Unable to fetch weather infomation for ${city.value}` ;
        setTimeout(() => {
            errorMessage.value = "";
            city.value = "";
        }, 4000)
      }
    });
};
const capitalize = (word) => {
    return word[0].toUpperCase() + word.slice(1);
};

const clearResult = () => {
    weather.value = "";
    city.value = "";
    cityName.value = "";
};
</script>

<style scoped>
.close-btn{
    position: absolute;  
    top: 3px;
    right: 3px;
    border: 1px solid #fff;
    border-radius: 50%;
    cursor: pointer;
}
</style>