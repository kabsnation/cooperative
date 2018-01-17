USE [COOP]
GO

/****** Object:  Table [dbo].[Document_Type]    Script Date: 07/09/2017 20:28:58 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Document_Type](
	[idDocument_Type] [int] NOT NULL,
	[Document] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Document_Type] PRIMARY KEY CLUSTERED 
(
	[idDocument_Type] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

