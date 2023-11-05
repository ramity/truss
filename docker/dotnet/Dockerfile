FROM mcr.microsoft.com/dotnet/sdk:6.0

WORKDIR /root/server

RUN apt update
RUN apt upgrade -y
RUN apt install -y software-properties-common
RUN dotnet dev-certs https -ep /usr/local/share/ca-certificates/aspnet/https.crt --format PEM
RUN update-ca-certificates
RUN dotnet tool install --global dotnet-ef
RUN PATH="$PATH:/root/.dotnet/tools"

ENTRYPOINT sleep infinity
