<template>
    <div class="input-container">
            <InputComponent
                type="text"
                name="username"
                text=""
                color=""
                readonly="0"
            >

            </InputComponent>
            <InputComponent
                type="password"
                name="password"
                text=""
                color=""
                readonly="0"
            >

            </InputComponent>
            <InputComponent
                type="submit"
                name="submit"
                text="Sign in"
                color="blue"
                readonly="0"
            >

            </InputComponent>
            <div class="error-messages" v-if="errors_array.length > 0">
                <ul>
                    <li v-for="error in errors_array" v-text="error"></li>
                </ul>
            </div>
    </div>

</template>

<script>
import InputComponent from "./InputComponent";
export default {
    name: "Login",
    props: ['errors'],
    components: {
        InputComponent,
    },
    data() {
        return {
            errors_array: []
        }
    },
    mounted() {
        let arr = this.errors.split('|');
        this.errors_array = arr.filter((item) => item.length > 0)
    }
}
</script>

<style scoped>
.input-container {
    height: 200px;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
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
