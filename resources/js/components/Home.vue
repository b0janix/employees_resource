<template>
    <div v-if="authorization" class="authorization-section">
        <div class="authorization-message">
            <p><i>"Employees Client"</i> is requesting permission to access your account</p>
        </div>
        <div class="authorization-buttons">
            <form :action="route" method="post">
                <InputComponent
                    type="submit"
                    name="authorizeSubmit"
                    text="Authorize"
                    color="blue"
                />
                <InputComponent
                    type="hidden"
                    name="client_id"
                    :text="client_id"
                />

                <InputComponent
                    type="hidden"
                    name="redirect_uri"
                    :text="redirect_uri"
                />
                <InputComponent
                    type="hidden"
                    name="_token"
                    :text="csrf"
                />
            </form>
            <ButtonComponent text="Cancel" color="red" @click="clickCancel">

            </ButtonComponent>
        </div>
        <div class="error-messages" v-if="errors_array.length > 0">
            <ul>
                <li v-for="error in errors_array" >{{error}}</li>
            </ul>
        </div>
    </div>
    <div v-else>
        <div v-if="checkForClients">
            <div class="input-container" v-for="inputData in inputCollection">
                <InputComponent
                    type="text"
                    name="client_name"
                    readonly="1"
                    :text="inputData.client_name"
                    color=""/>
                <InputComponent
                    type="text"
                    name="redirect_uri"
                    readonly="1"
                    :text="inputData.redirect_uri"
                    color=""/>
                <InputComponent
                    type="text"
                    name="client_id"
                    readonly="1"
                    :text="inputData.client_id"
                    color=""/>
                <form
                    :action="route"
                    method="post"
                    id="logoutForm"
                >
                    <InputComponent
                        type="submit"
                        name="logoutSubmit"
                        text="Sign out"
                        color="red"
                    />
                    <InputComponent
                        type="hidden"
                        name="_token"
                        :text="csrf"
                    />
                </form>
            </div>
        </div>
        <div v-else>
            Please wait...
        </div>
    </div>
</template>

<script>
import InputComponent from "./InputComponent";
import ButtonComponent from "./ButtonComponent";
export default {
    name: "Home",
    props: [
        'route',
        'authorize',
        'csrf',
        'client_id',
        'redirect_uri',
        'errors'
    ],
    components: {
        InputComponent,
        ButtonComponent
    },
    data() {
        return {
            inputCollection: [],
            authorization: false,
            errors_array: []
        }
    },
    methods: {
        async getAuthDetails() {
            await axios.get('/get_client')
                .then((response) => {
                    this.inputCollection = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        checkForAuthorize() {
            return this.authorize === "1";
        },
        clickCancel() {
            window.location.href = 'http://localhost:8080/home';
        },
        checkForClients() {
            return this.inputCollection.length > 0
        }
    },
    mounted() {
        this.authorization = this.checkForAuthorize();
        if(this.authorization) {
            let arr = this.errors.split('|');
            this.errors_array = arr.filter((item) => item.length > 0)
        }
        else{
            this.getAuthDetails();
        }
    }
}
</script>

<style scoped>
.input-container {
    height: 200px;
    display: flex;
    flex-flow: column;
    align-items: center;
    margin-top: 50px;
}
.authorization-section {
    height: 200px;
    display: flex;
    flex-flow: column;
    align-items: center;
    margin-top: 50px
}
.authorization-buttons {
    display: flex;
    flex-flow: row;
    justify-content: center;
    margin-top: 20px;
}
.error-messages {
    font-size: 14px;
    margin: 20px;
    color: red;
    text-decoration: none;
}

.error-messages ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
</style>
