FROM node:19.5.0-alpine
RUN apk update
RUN apk add git
RUN git clone https://github.com/pieryx/Api-TypeScript
RUN mkdir -p /Api-TypeScript/back/node_modules && chown -R node:node /Api-TypeScript/back
WORKDIR /Api-TypeScript/back
USER node
RUN npm install
EXPOSE 3000
CMD npm start 