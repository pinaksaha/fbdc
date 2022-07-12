# FBDC [Pinak Saha]

# [LaraDock](https://laradock.io/)
- I am using laradock to run this instance locally

# Use Libraries
- [Guzzel](https://docs.guzzlephp.org/en/stable/) for retrieving random user data

# Random User Api
    /random_user/{numberOfUsers}
    numberOfUserss is not strickly required, it deulfts 1
    if numberOfUsers is provided it must be an integer

# Structure

```
\App
    \Gateway\RandomUserGateway - Gets data from API
    \Formatter\RandomPersonFormatter - Formatts data for user
    \Parser\RandomUserParser - Parses & Normalizw API Data
    \Controller\RandomPersonController - Rturns user data based on request
```
