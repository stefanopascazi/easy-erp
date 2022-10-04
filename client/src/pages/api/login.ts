// Next.js API route support: https://nextjs.org/docs/api-routes/introduction
import type { NextApiRequest, NextApiResponse } from 'next'
import axios, {AxiosResponse} from 'axios'
import Cookies from 'cookies'
import jwt_decode from "jwt-decode";

type Data = {
	data?: string,
	message?: any
}

export default async function handler(
	req: NextApiRequest,
	res: NextApiResponse<Data>
) {
	const body = req.body

	// Guard clause checks for first and last name,
	// and returns early if they are not found
	if (!body.username || !body.password) {
		// Sends a HTTP bad request error code
		return res.status(400).json({ data: 'First or last name not found' })
	}

	try {
		const response: AxiosResponse<any, any> = await axios.post("http://127.0.0.1:8000/login", JSON.stringify(body), {
			headers: {
				"Content-Type": "application/json",
				"Accept": "application/json"
			}
		})

		if (response.status !== 200) {
			res.status(200).json({
				data: "Si è verificato un errore",
				message: response.data
			})
		}

		const decode: any = jwt_decode(response.data.token);


		const roles = decode.roles.filter((v:any) => v === "ROLE_ADMIN" || v === 'ROLE_SUPER_ADMIN')
		if( roles.length === 0)
		{
			return res.status(401).redirect("/?error=access denied")
			
		}

		const cookies = new Cookies(req, res)
		cookies.set("auth-token", response.data.token, {
			httpOnly: true,
			expires: new Date(Date.now() + 86400 * 1000),
			sameSite: 'lax',
			path: "/"
		})

	} catch (e:any) {
		return res.status(401).redirect(`/?error=${e.message}`)
	}

	// Found the name.
	// Sends a HTTP success code
	return res.status(200).redirect("/about")
}
