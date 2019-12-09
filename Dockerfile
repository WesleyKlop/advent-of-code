# Build applications
FROM node:current-alpine AS build

WORKDIR /app
COPY src ./src
COPY package.json .
COPY yarn.lock .
COPY webpack.config.js .

RUN yarn install && \
    yarn build -p

# App phase
FROM node:current-alpine AS app

LABEL version='9.0.0'

WORKDIR /app
COPY --from=build /app/dist .
VOLUME [ "/app/inputs" ]

ENTRYPOINT ["node", "main.js"]

CMD [ "all" ]
