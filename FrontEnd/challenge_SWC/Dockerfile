FROM node:20.17.0-alpine

RUN mkdir /app

WORKDIR /app

COPY . /app

RUN npm install

EXPOSE 3000

CMD [ "npm", "run", "dev" ]
#CMD [ "top" ]