USE [COOP]
GO

/****** Object:  Table [dbo].[Coop_Asset]    Script Date: 07/09/2017 20:28:43 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Coop_Asset](
	[idCoop_Asset] [int] NOT NULL,
	[Total_Coop_Asset] [int] NOT NULL,
	[Beginning] [varchar](50) NOT NULL,
	[To_Date] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Coop_Asset] PRIMARY KEY CLUSTERED 
(
	[idCoop_Asset] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

