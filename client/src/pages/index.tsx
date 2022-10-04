import type { GetServerSideProps, NextPage } from 'next'
import Head from 'next/head'
import Link from 'next/link'
import { Row, Col, Form, Button, Alert} from 'react-bootstrap'
import { checkToken } from '../helper/checktoken'

import { useRouter } from "next/router";
import React from "react";

const Home: NextPage = () => {

	const router = useRouter()
	const [error, setError] = React.useState<string | string[]>()

	React.useEffect(() => {
		if(!router.isReady) return;
		const query = router.query;

		setError(query.error)
	}, [router.isReady, router.query])

	return (
		<div>
			<Head>
				<title>Login | Easy-ERP</title>
				<meta name="description" content="Easy-ERP login page" />
				{/* <link rel="icon" href="/favicon.ico" /> */}
			</Head>
			<Row className='justify-content-center'>
				<Col xs={12} md={8} lg={4}>
					{error && <Alert key={"danger"} variant={"danger"}>{error}</Alert>}
					<Form action={'/api/login'} method={'post'}>
						<Form.Group className={"mt-3"}>
							<Form.Label>email</Form.Label>
							<Form.Control type={"email"} name={"username"} required />
						</Form.Group>
						<Form.Group className={"mt-3"}>
							<Form.Label>password</Form.Label>
							<Form.Control type={"password"} name={"password"} required />
						</Form.Group>
						<Form.Group className={"mt-3"}>
							<Button type={"submit"}>Login</Button>
						</Form.Group>
					</Form>
				</Col>
			</Row>
			<Row>
				<Link href={"/about"}>About page</Link>
			</Row>
		</div>
	)
}

export const getServerSideProps: GetServerSideProps = async({req, res}) => {

	const access = await checkToken(req, res)
	if( access )
	{
		return {
			redirect: {
				permanent: false,
				destination: "/about"
			},
			props: {}
		}
	}

	return {
		props: {}
	}
}

export default Home
