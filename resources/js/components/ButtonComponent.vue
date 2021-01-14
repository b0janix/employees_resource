<template>
    <div class="single-button-container">
        <button :class="[buttonColor, 'button-general']">
            {{button_text}}
        </button>
    </div>
</template>

<script>
export default {
    name: "ButtonComponent",
    props: ['text','color'],
    data() {
        return {
            button_text: this.text,
            button_color: this.color
        }
    },
    computed: {
        buttonColor() {
            return this.button_color === 'blue' ? 'blue-button' : 'red-button'
        }
    }
}
</script>

<style scoped>
    .single-button-container {
        margin-top: 10px;
    }
    .blue-button {
        background-color: cornflowerblue;
    }
    .red-button {
        background-color: red;
    }
    .button-general {
        padding: 5px;
        border-radius: 3px;
        color: white;
        border: 1px solid white;
        width: 100px;
    }
</style>
