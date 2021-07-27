import router from "../router";
import httpClient from "./http.service";

const authService = {

    user: null,
    isLoggedIn() {
        return !!localStorage.getItem('access_token')
    },
    async login(formData) {
        try {
            const {status, data} = await httpClient.post('user/login', formData)
            if (status === 200) {
                this.setUser(data)
                return {success: true}
            }
        } catch (e) {
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    async register(formData) {
        try {
            const {status, data} = await httpClient.post('user/register', formData)
            if (status === 200) {
                this.setUser(data)
                return {success: true}
            }
        } catch (e) {
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },

    logout: () => {
        localStorage.removeItem('access_token')
        router.push({name: 'login'})
    },


    setUser(user) {
        this.user = user
        localStorage.setItem('access_token', this.user.access_token)
    },

    isGuest: () => !localStorage.getItem('access_token'),

    getToken: () => localStorage.getItem('access_token'),


    async getUser() {
        try {
            if (!this.user) {
                const {status, data} = await httpClient.get('/user/data');
                if (status === 200) {
                    this.user = data;
                }
            }

        } catch (e) {
            console.log(e.response)
            return null;
        }

        return this.user;
    }

}


export default authService