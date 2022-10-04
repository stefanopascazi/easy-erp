import Cookies from 'cookies'
import axios from 'axios'
const checkToken = async(req:any, res:any) => {
    const cookies = new Cookies(req, res)

	const token: string | undefined = cookies.get("auth-token");

	if( typeof token !== 'undefined' )
	{
		try {
			const response = await axios.get("http://127.0.0.1:8000/auth/ping", {
				headers: {
					"Content-Type":"application/json",
					"Accept":"application/json",
					"Authorization":`Bearer ${token}`
				}
			})
			if( response.status === 200 )
			{
                return true
			}
		} catch(e){
            return false
        }
	}

    return false
}

export {
    checkToken
}