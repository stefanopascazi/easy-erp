import type { AppProps } from 'next/app'
import {useRouter} from 'next/router';
import nProgress from 'nprogress'; //nprogress module
import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../styles/nprogress.css'; //styles of nprogress
import Layout from '../components/layout';
//Route Events. 
// NProgress.configure({ showSpinner: false })
// Router.events.on('routeChangeStart', () => NProgress.start()); 
// Router.events.on('routeChangeComplete', () => NProgress.done()); 
// Router.events.on('routeChangeError', () => NProgress.done());

function MyApp({ Component, pageProps }: AppProps) {

	const router = useRouter()

	React.useEffect(() => {
		const handleStart = (url: string): void => {
			nProgress.start()
		}

		const handleStop = (): void => {
			nProgress.done()
		}

		router.events.on('routeChangeStart', handleStart)
		router.events.on('routeChangeComplete', handleStop)
		router.events.on('routeChangeError', handleStop)

		return () => {
			router.events.off('routeChangeStart', handleStart)
			router.events.off('routeChangeComplete', handleStop)
			router.events.off('routeChangeError', handleStop)
		}
	}, [router])

  return <Layout>
			<Component {...pageProps} />
		</Layout>
}

export default MyApp
