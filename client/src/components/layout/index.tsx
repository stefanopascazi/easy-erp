import {Container} from 'react-bootstrap'

type layout = {
    children?: React.ReactNode | React.ReactNode []
}

const Layout = ({children}: layout) => {
    return <Container fluid>
        {children}
    </Container>
}

export default Layout