import {useSetupStore} from "@/stores/setupStore.js";
import {toRef} from "vue";
import axios from "axios";

async function authenticationConfirmed(token,host) {
    try {
        const response = await axios.get(host.value+'/api/user', {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`,
            },
        });
    } catch (error) {
        console.error('Invalid token:', error.response.data);
        localStorage.clear();
        clear()
    }
}

const setUpReturn = () => {
    return {
        setup(){
            const setupStore = useSetupStore()
            return {setupStore}
        }
    }
}


async function is_Authenticated(asyncStatus){
    const setUpStore = setUpReturn().setup().setupStore
    const host = toRef(setUpStore.host)

    const token = localStorage.getItem('token');
    const Json_user = localStorage.getItem('user');

    if (token === null || token === '') {return false;}

    if (Json_user === null || Json_user === '') {return false;}

    if (asyncStatus) {
        try {
            await authenticationConfirmed(token,host);
            return true;
        } catch (error) {
            console.error('Authentication failed:', error);
            return false;
        }
    }else {
        return true
    }
}

export {is_Authenticated}





