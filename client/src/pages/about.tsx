import type { GetServerSideProps, NextPage } from 'next'
import Head from 'next/head'
import Link from 'next/link'
import { checkToken } from '../helper/checktoken'

const About: NextPage = () => {
	return (
		<div>
			<Head>
				<title>Login successfully</title>
				<meta name="description" content="Generated by create next app" />
				<link rel="icon" href="/favicon.ico" />
			</Head>
			<div>
				<p>About page</p>
			</div>
			<div>
				<Link href={"/"}>login page</Link>
			</div>
		</div>
	)
}



export const getServerSideProps: GetServerSideProps = async({req, res}) => {

	const access = await checkToken(req, res)
	if( !access )
	{
		return {
			redirect: {
				permanent: false,
				destination: "/"
			},
			props: {}
		}
	}

	return {
		props: {}
	}
}

export default About
