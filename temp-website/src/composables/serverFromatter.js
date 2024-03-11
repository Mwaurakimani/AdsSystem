import {reactive} from "vue";

const errorsValues = reactive({})

const formatErrors  = (err) => {



    const errors = err?.response?.data?.errors;

    if (errors){
        Object.keys(errorsValues).forEach(property => {
            delete errorsValues[property];
        });

        Object.keys(errors).forEach(property => {
            errorsValues[property] = errors[property];
        });
    }
}

export {errorsValues, formatErrors}